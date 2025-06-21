<?php

namespace App\Mail;

use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorStatusMail extends Mailable
{
    use Queueable, SerializesModels;



    public $visitor;
    public $status;
    public $permitNumber;
    public $filePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct(Visitor $visitor, $status, $permitNumber = null, $filePath = null)
    {
        $this->visitor = $visitor;
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
        $subject = 'Visitor Status Update: ' . $this->status;

        // Mengirim email dengan subject dan data visitor
        $email = $this->subject($subject)
                      ->view('emails.visitor_status') // Pastikan Anda sudah membuat view ini
                      ->with([
                          'visitorName' => $this->visitor->pic_name,
                          'note_visitor' => $this->visitor->note_visitor,
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
