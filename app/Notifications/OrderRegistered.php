<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderRegistered extends Notification
{
    
    use Queueable;
    
    /**
     * @var Order
     */
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
            ->subject(__('Order payment completed'))
            ->line(__('Your order has been paid successfully. To see order details please click on the below button'))
            ->action(__('See order'), route('users.orders.index', [$this->locale, auth()->user()]))
            ->line(__('Thanks for using our application'));
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
                'fa' => 'سفارش شماره '.$this->order->id.'پرداخت شد.',
                'en' => 'Order '.$this->order->id.' has been paid'
            ],
            'link' => route('users.orders.index', [$this->locale, auth()->user()])
        ];
    }
}
