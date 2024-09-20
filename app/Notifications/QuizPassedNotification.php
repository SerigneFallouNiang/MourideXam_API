<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Quizze;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuizPassedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Quizze $quiz, $score, $percentage)
    {
        $this->user = $user;
        $this->quiz = $quiz;
        $this->score = $score;
        $this->percentage = $percentage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Félicitations pour avoir réussi le quiz !')
        ->greeting('Bonjour ' . $this->user->name . ' !')
        ->line('Félicitations, vous avez réussi le quiz "' . $this->quiz->title . '" avec un score de ' . $this->percentage . '%.')
        ->line('Vous avez répondu correctement à ' . $this->score . ' questions sur ' . $this->quiz->questions()->count() . '.')
        ->line('Continuez ainsi et améliorez vos connaissances !')
        ->action('Voir vos résultats', url('/quizzes/' . $this->quiz->id))
        ->line('Merci pour votre participation !');
}   
    }

  
