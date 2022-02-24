<?php

namespace App\Mail;

use App\Models\Bill;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $bill;
    public $vendor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bill $bill, Vendor $vendor)
    {
        $this->bill = $bill;
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->bill->getCompany->email)
            ->subject($this->bill->getCompany->company_name.' - Bill')
            ->markdown('emails.bill.bill');
    }
}
