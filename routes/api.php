<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserProgresController;
use App\Http\Controllers\UserQuizResultController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


// progression d'un user 
Route::middleware('auth:api')->get('/user-progress', [UserProgresController::class, 'getUserProgress']);

// Passer un quiz pour un apprenant 
Route::middleware('auth:api')->group(function () {


  Route::get("profile", [ApiController::class, "profile"]);
  Route::get("refresh", [ApiController::class, "refreshToken"]);
  Route::get("logout", [ApiController::class, "logout"]);
//gestion profil d'un utilisateur
Route::put('/user/profile', [RegisteredUserController::class, 'update']);
});

// Question routes
Route::get('quizzes/{quizId}/questions', [QuestionController::class, 'index']);
Route::get('questions/{question}', [QuestionController::class, 'show']);
Route::post('questions', [QuestionController::class, 'store']);
Route::put('questions/{question}', [QuestionController::class, 'update']);
Route::delete('questions/{question}', [QuestionController::class, 'destroy']);


// result of the quiz user 
Route::apiResource('user-quiz-results', UserQuizResultController::class);


//answer
Route::apiResource('answers', AnswerController::class);
//Questions
Route::apiResource('questions', QuestionController::class);

// Quiz routes
Route::get('chapters/{chapterId}/quizzes', [QuizzeController::class, 'index']);
Route::get('quizzes/{quizze}', [QuizzeController::class, 'show']);
Route::post('quizzes', [QuizzeController::class, 'store']);
Route::put('quizzes/{quizze}', [QuizzeController::class, 'update']);
Route::delete('quizzes/{quizze}', [QuizzeController::class, 'destroy']);

// Route::apiResource('quizzes', QuizzeController::class);
// Route::resource('quizzes',QuizzeController::class);



// Route::middleware('auth:api')->group(function () {
  Route::apiResource('roles', RoleController::class);
  Route::get('/permissions', [RoleController::class, 'listPermission'])->name('permissions.list');

  //route pour passer un quiz
  Route::get('/quiz/start/{chapterId}', [QuizzeController::class, 'startQuiz']);
Route::post('/quiz/submit/{quizId}', [QuizzeController::class, 'submitQuiz']);
// });

// Route::group(['middleware' => ['auth:api']], function() {
// categories
// listes des livres par categorie 
Route::get('categories/{categoryId}/books', [CategoryController::class, 'getBooks']);
Route::resource('categories',CategoryController::class);
Route::delete('categories_mass_destroy', [CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

// });


//livres 
// récupération de l'historie des livre par rapport à l'utilisateur connecter 
Route::get('/books/read-chapters/user', [BookController::class, 'getBooksWithReadChaptersByUser']);

Route::apiResource('books', BookController::class)->only('store', 'destroy');
Route::apiResource('books', BookController::class)->only('index', 'show');
Route::post('books/{book}', [BookController::class, 'update']);
// Route::get('/books/{id}/chapters', [BookController::class, 'getChaptersByBook']);


//Chapitre
// Route::get('/books/{bookId}/chapters/status', [ChapterController::class, 'getChapterEtatByUser']);
Route::get('/books/{bookId}/chapters', [ChapterController::class, 'getChapterEtatByUser']);

// Route::middleware('auth:api')->get('/books/{bookId}/chapters', [ChapterController::class, 'getBooksByBook']);
//Marqué un chapitre comme lue
Route::post('/chapters/{id}/mark-read', [ChapterController::class, 'markAsRead']);
//route crud chapitre
Route::apiResource('chapters', ChapterController::class);
//route pour l'upload d'une video à un chapitre
Route::post('/chapters/{chapter}/upload-video', [ChapterController::class, 'uploadVideo']);
//lire video 
Route::get('/chapters/{id}/videos', [ChapterController::class, 'readVideo']);

// Ajoute une route pour permettre la conversion du PDF en images.
// Route::get('/chapters/{id}/convert', [ChapterController::class, 'convertToImages']);


//récupérationdu pdf d'un chapitre
Route::get('/chapter/{id}/download', [ChapterController::class, 'downloadPdf']);








//les routes du packege breez
Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');


Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::get('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:api');






//changement de langue
Route::get('/langue/{lang}', function ($lang, Request $request) {
  // Vérifie si la langue est valide
  $availableLangs = ['fr', 'en', 'wo', 'ar'];

  if (in_array($lang, $availableLangs)) {
      // Récupère l'utilisateur authentifié
      $user = Auth::user();

      // Met à jour la préférence de langue dans le profil de l'utilisateur (si vous avez un champ pour ça)
      $user->language = $lang;
      $user->save();

      // Renvoie une réponse JSON
      return response()->json(['message' => 'Langue changée avec succès', 'lang' => $lang]);
  }

  // Langue non valide
  return response()->json(['message' => 'Langue invalide'], 400);
})->middleware('auth:api')->name('lang.change');