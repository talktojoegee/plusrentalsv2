<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice as InvoiceModel;
use App\Models\TenantApplicant;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InvoiceModel $invoice, TenantApplicant $applicant)
    {
        $this->invoice = $invoice;
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->invoice->getCompany->email)
            ->subject($this->invoice->getCompany->company_name.' - Invoice')
            ->markdown('emails.invoice.invoice');
    }
}
