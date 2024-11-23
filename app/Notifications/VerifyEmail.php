<?php
//
//namespace App\Notifications;
//
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Notifications\Messages\MailMessage;
//use Illuminate\Notifications\Notification;
//use Illuminate\Support\Facades\URL;
//
//
//class VerifyEmail extends Notification
//{
//    use Queueable;
//
//    /**
//     * Create a new notification instance.
//     */
//    public function __construct()
//    {
//        //
//    }
//
//    /**
//     * Get the notification's delivery channels.
//     *
//     * @return array<int, string>
//     */
//    public function via(object $notifiable): array
//    {
//        return ['mail'];
//    }
//
//    /**
//     * Get the mail representation of the notification.
//     */
//
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//            ->subject('Verify Your Email Address')
//            ->line('Please click the button below to verify your email address.')
//            ->action('Verify Email', URL::temporarySignedRoute('verification.verify', now()->addHours(24), ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)]))
//            ->line('Thank you for using our application!');
//    }
//
//    /**
//     * Get the array representation of the notification.
//     *
//     * @return array<string, mixed>
//     */
//    public function toArray(object $notifiable): array
//    {
//        return [
//            //
//        ];
//    }
//}
