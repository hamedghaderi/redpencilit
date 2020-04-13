<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderPaid extends Notification
{
    
    use Queueable;
    
    protected $order;
    
    public $locale;
    
    /**
     * Create a new notification instance.
     *
     * @param  Order  $order
     * @param $locale
     */
    public function __construct(Order $order, $locale)
    {
        $this->order = $order;
        
        $this->locale = $locale;
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
        return ['emails', 'database'];
    }
    
    /**
     * Get the emails representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(auth()->user()->email)
            ->line(auth()->user()->name.__(' paid a new order.'))
            ->action(
                'Show order',
                route('admin.orders.show', [app()->getLocale(), $this->order])
            );
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
                'fa' => auth()->user()->name.' سفارش جدیدی را پرداخت کرد.',
                'en' => auth()->user()->name.' paid a new order',
            ],
            'link' => route('admin.orders.show', [$this->locale, $this->order])
        ];
    }
}
