<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TreeNotification extends Notification
{
    use Queueable;

    protected $tree_notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tree_notification)
    {
        $this->tree_notification = $tree_notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id'   => $this->tree_notification['user_id'],
            'tree_id'   => $this->tree_notification['tree_id'],
            'tree_code' => $this->tree_notification['tree_code'],
            'latitude'  => $this->tree_notification['latitude'],
            'longitude' => $this->tree_notification['longitude']
        ];
    }
}
