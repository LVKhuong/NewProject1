<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCartToMail extends Mailable
{
   use Queueable, SerializesModels;

   public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($details)
   {
      $this->details = $details;
   }

    /**
     * Build the message.
     *
     * @return $this
     */
   public function build()
   {
      return $this->subject("Shop KhuongABC xác nhận đơn hàng bạn đã đặt")->view('admin.mail.xem');
   }
}
