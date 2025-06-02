<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $status;
    public $permitNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, $status, $permitNumber = null)
    {
        $this->vendor = $vendor;
        $this->status = $status;
        $this->permitNumber = $permitNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Vendor Status Update: ' . $this->status;

        // Mengirim email dengan subject dan data vendor
        return $this->subject($subject)
                    ->view('emails.vendor_status') // Pastikan Anda sudah membuat view ini
                    ->with([
                        'vendorName' => $this->vendor->company_name,
                        'status' => $this->status,
                        'permitNumber' => $this->permitNumber,
                    ]);
    }
}
