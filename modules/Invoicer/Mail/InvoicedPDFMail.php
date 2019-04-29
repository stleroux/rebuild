<?php

namespace Modules\Invoicer\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Invoicer\Entities\Invoice;

class InvoicedPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = (public_path("/invoices") . DIRECTORY_SEPARATOR . $this->invoice->id . '.pdf');
            
        return $this->view('invoicer::emails.invoicedPDF')
            ->subject('Invoice from TheWoodBarn.ca')
            ->attach($pdf);
    }
}
