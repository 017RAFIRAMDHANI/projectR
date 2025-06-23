<?php

namespace App\Mail;

use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorForm extends Mailable
{
    use Queueable, SerializesModels;
    public $visitor;

    // Konstruktor menerima objek visitor
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function build()
    {
        return $this->subject('Visitor Form Submission')
                    ->view('emails.vendor_form')
                    ->with([
                        'email' => $this->visitor->email,
                        'companyName' => $this->visitor->company_name,
                        'requestorName' => $this->visitor->pic_name,
                        'companyContact' => $this->visitor->pic_contact,
                        'submissionTime' => now(), // Waktu pengajuan
                        'workDescription' => $this->visitor->purpose_detail,
                        'location' => $this->visitor->building . ' ' . $this->visitor->level . ' ' . $this->visitor->specific_location,
                        'vehicle' => $this->visitor->vehicle_type . ' (' . $this->visitor->car_plate_no . ')',
                        'status' => $this->visitor->status,
                        'permitValidityFrom' => $this->visitor->request_date_from,
                        'permitValidityTo' => $this->visitor->request_date_to,
                    ]);
    }
}
