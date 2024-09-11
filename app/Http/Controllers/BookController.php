<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Book::all();
        return response()->json(['message' => 'Liste des livres', 'Livres' => $livres], 201);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $livre = new Book();
        $livre->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $livre->image = $image->store('livres', 'public');
        }
        $livre->save();
        return response()->json(['message' => 'Livre créé avec succès', 'Livre' => $livre], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->fill($request->validated());
        if ($request->hasFile('image')) {

            if (File::exists(public_path("storage/" . $book->image))) {
                File::delete(public_path($book->image));
            }
            $image = $request->file('image');
            $book->image = $image->store('livres', 'public');
        }
        // dd($livre->image);
        if ($book->quantite > 0) {
            $book->update(['disponible' => true]);
        }
        $book->update();
        return response()->json(['message' => 'Livre modifié avec succès', 'Livre' => $book], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Livre supprimé avec succès', 'Livre' => $book], 201);
    }
}
