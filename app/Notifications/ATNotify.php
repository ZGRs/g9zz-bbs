<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ATNotify extends Notification
{
    use Queueable;


    public $at;

    public function __construct($at)
    {
        $this->at = $at;
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
            'post_hid' => $this->at->post_hid,//帖子ID
            'from_id' => $this->at->from_id,//谁艾特了你
            'to_id' => $this->at->to_id,//你的ID
            'type' => 'at',//类型
            'body' => $this->at->body,//艾特里的内容
            'body_original' => $this->at->body_original//艾特里原内容
        ];
    }
}
