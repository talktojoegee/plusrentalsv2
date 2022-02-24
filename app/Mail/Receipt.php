<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Receipt as ReceiptModel;

class Receipt extends Mailable
{
    use Queueable, SerializesModels;
    public $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReceiptModel $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.receipt.receipt');
        return $this->from('info@gmail.com')
            ->subject('Rent Receipt')
            ->markdown('mails.receipt.receipt');
    }
}
