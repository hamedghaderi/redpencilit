<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReplyCompleted extends Notification
{
    use Queueable;

    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new notification instance.
     *
     * @param  Order  $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('Hello, ').$this->order->owner->name)
            ->subject(__('You Have Some New Attachment About Your Order'))
            ->line(__('For order number #').$this->order->id.__(' some new attachments has been uploaded recently.'))
            ->line(__('You can check the link below to see your files'))
            ->action(__('See attachments'), route('users.orders.show', [app()->getLocale(),
                $this->order->owner, $this->order]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => [
                'fa' => 'برای سفارش شماره #'.$this->order->id.' فایل جدیدی آپلود شد.',
                'en' => 'For order number #'.$this->order->id.' some new file has been uploaded.'
            ],
            'link' => route('users.orders.show', [app()->getLocale(), $this->order->owner, $this->order])
        ];
    }
}
