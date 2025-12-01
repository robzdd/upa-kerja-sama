<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicantNotification extends Notification
{
    use Queueable;

    public $pelamar;

    /**
     * Create a new notification instance.
     */
    public function __construct($pelamar)
    {
        $this->pelamar = $pelamar;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pelamar_id' => $this->pelamar->id,
            'pelamar_name' => $this->pelamar->user->name,
            'lowongan_judul' => $this->pelamar->lowongan->judul,
            'message' => 'Lamaran baru dari ' . $this->pelamar->user->name . ' untuk posisi ' . $this->pelamar->lowongan->judul,
            'created_at' => now(),
        ];
    }
}
