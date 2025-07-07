<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class VendorForm extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;

    // Konstruktor menerima objek Vendor
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function build()
    {
        return $this->subject('Work Permit Request '.$this->vendor->company_name)
                    ->view('emails.vendor_form') // Pastikan sudah membuat view ini
                    ->with([
                        'email' => $this->vendor->email,
                        'companyName' => $this->vendor->company_name,
                        'companyContact' => $this->vendor->company_contact,
                        '' => $this->vendor->phone_number,
                        'requestorName' => $this->vendor->requestor_name,
                        'phoneNumber' => $this->vendor->phone_number,
                        'submissionTime' => now(), // Waktu pengajuan
                        'workDescription' => $this->vendor->work_description,
                        'location' => $this->vendor->building . ' ' . $this->vendor->level . ' ' . $this->vendor->specific_location,
                        'vehicle' => $this->vendor->vehicle_types . ' (' . $this->vendor->number_plate . ')',
                        'status' => $this->vendor->status,
                      // Menggunakan format dd/mm/yyyy untuk validity date
                    'permitValidityFrom' => Carbon::parse($this->vendor->validity_date_from)->format('d/m/Y'),
                    'permitValidityTo' => Carbon::parse($this->vendor->validity_date_to)->format('d/m/Y'),

                    ]);
    }
}
