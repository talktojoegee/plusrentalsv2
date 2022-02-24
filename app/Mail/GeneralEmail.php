<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\Email;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $tenant, $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email, Tenant $tenant, Company $company)
    {
        $this->email = $email;
        $this->tenant = $tenant;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->company->email)
            ->subject($this->email->subject)
            ->markdown('emails.general-email');
    }
}
