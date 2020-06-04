<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChanged extends Notification
{
    
    use Queueable;
    
    /**
     * @var Order
     */
    protected $order;
    
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
            ->subject(__('Your order status has been changed.'))
            ->greeting(__('Hello, ').$this->order->owner->name)
            ->line(__('Recently your order status has been changed to ').$this->order->status
                   .__('. To see order details click on the button below.'))
            ->action(__('Order Details'), route('users.orders.index', [app()->getLocale(), $this->order]))
            ->line(__('Thank you for using our application!'))
            ->salutation(__('Sincerely'));
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
                'fa' => __('وضعیت سفارش شماره '.$this->order->id.' تغییر یافت. '),
                'en' => __('Order number '.$this->order->id.' status has been changed.')
            ],
            'link' => route('users.orders.index', [app()->getLocale(), $this->order->owner])
        ];
    }
}
