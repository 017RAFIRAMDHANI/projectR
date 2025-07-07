<?php

namespace App\Mail;

use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

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
        return $this->subject('Visitor Permit Request '.$this->visitor->name_1)
                    ->view('emails.visitor_form')
                    ->with([
                        'email' => $this->visitor->email,
                        'companyName' => $this->visitor->company_name,
                        'requestorName' => $this->visitor->name_1,
                        'companyContact' => $this->visitor->pic_contact,
                        'submissionTime' => now(), // Waktu pengajuan
                        'workDescription' => $this->visitor->purpose_detail,
                        'purpose' => $this->visitor->purpose_visit,
                        'location' => $this->visitor->building . ' ' . $this->visitor->level . ' ' . $this->visitor->specific_location,
                        'vehicle' => $this->visitor->vehicle_type . ' (' . $this->visitor->car_plate_no . ')',
                        'status' => $this->visitor->status,
                     // Menggunakan format dd/mm/yyyy
                        'permitValidityFrom' => Carbon::parse($this->visitor->request_date_from)->format('d/m/Y'),
                        'permitValidityTo' => Carbon::parse($this->visitor->request_date_to)->format('d/m/Y'),

                    ]);
    }
}
