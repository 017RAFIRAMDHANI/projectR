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
    public $filePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct(Vendor $vendor, $status, $permitNumber = null, $filePath = null)
    {
        $this->vendor = $vendor;
        $this->status = $status;
        $this->permitNumber = $permitNumber;
        $this->filePath = $filePath; // Menyimpan file path PDF

    }


    /**
     * Build the message.
     *
     * @return $this
     */
 public function build()
    {
        $subject = 'Work Permit Status Update: ' . $this->status;

        // Mengirim email dengan subject dan data vendor
        $email = $this->subject($subject)
                      ->view('emails.vendor_status') // Pastikan Anda sudah membuat view ini
                      ->with([
                          'vendorName' => $this->vendor->company_name,
                          'note_vendor' => $this->vendor->note_vendor,
                          'status' => $this->status,
                          'permitNumber' => $this->permitNumber,

                      ]);

        // Jika file PDF path tersedia, lampirkan file PDF tersebut
        if ($this->filePath && file_exists($this->filePath)) {
            $email->attach($this->filePath, [
                'as' => 'Permit_' . $this->permitNumber . '.pdf', // Nama file saat dilampirkan
                'mime' => 'application/pdf', // Tipe MIME file
            ]);
        }

        return $email;
    }

}
