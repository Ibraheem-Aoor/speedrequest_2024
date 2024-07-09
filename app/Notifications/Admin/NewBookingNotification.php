<?php

namespace App\Notifications\Admin;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected Booking $booking)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'  , 'database'];
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
            ->line(__('general.notifications.new_booking' ,  ['client_name' => $this->booking->client_name , 'client_phone' => $this->booking->client_phone]))
            ->action(__('general.check_on_panel'), route('admin.booking.index' , ['booking_id' => $this->booking->id]))
            ->line(__('general.enjoy_your_time'));
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
            'title' => 'new_booking',
            'link' => config('app.url') . route('admin.booking.index' , ['booking_id' => $this->booking->id , 'notification_id' => $this->id] , false),
        ];
    }
}
