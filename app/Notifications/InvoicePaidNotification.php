<?php

namespace App\Notifications;

use App\Http\Controllers\admin;
use App\Model\order_details;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class InvoicePaidNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $Invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($Invoice)
    {
        //
        $this->Invoice = $Invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//
//        $show_detal=order_details::with(['order_photo'])
//            ->join('shipping','shipping.shipping_id','order_details.shipping_id')
//            -> join('Product','order_details.Product_id','Product.Product_id')
//            ->where('order_details.customer_id',4)->where('order_details.order_id', 2)->get();
//        $menu =  $this->Menu->show();
        return (new MailMessage)->view(
            'mail'

            , ['show_detal' => $this->Invoice['show_detal']]
//            , ['show_detal' => $show_detal]
        );
// ->greeting('Hello!')
//            ->markdown('markdown!')
////            ->level('level!')
//            ->salutation('salutation!')
//            ->subject('subject!')
//            ->line('One of your invoices has been paid!')
//                    ->action('Notification Action', url('/w'))
//            ->line('Thank you for using our application!');
////                    ->line('The introduction to the notification.')
////                    ->action('Notification Action', url('/'))
////                    ->line('Thank you for using our application!');
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
//            "show_detal"=>$this->Invoice['show_detal'],
//            "amount" => $this->Invoice['amount'],
        ];
    }
}
