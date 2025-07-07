<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorReject extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $status;


  public function __construct(Vendor $vendor, $status)
    {
        $this->vendor = $vendor;
        $this->status = $status;

    }

   public function build()
{
    $subject = 'Work Status Update: ' . $this->status;

    // Mengirim email dengan subject dan data vendor
    return $this->subject($subject)
                ->view('emails.vendor_status') // Pastikan Anda sudah membuat view ini
                ->with([
                    'vendorName' => $this->vendor->company_name,
                    'requestor_name' => $this->vendor->requestor_name,
                    'status' => $this->status,
                ]);
}

}
