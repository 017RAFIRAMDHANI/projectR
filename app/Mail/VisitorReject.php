<?php

namespace App\Mail;


use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorReject extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor;
    public $status;


  public function __construct(Visitor $visitor, $status)
    {
        $this->visitor = $visitor;
        $this->status = $status;

    }

   public function build()
{
    $subject = 'Visitor Status Update: ' . $this->status;

    // Mengirim email dengan subject dan data visitor
    return $this->subject($subject)
                ->view('emails.visitor_status') // Pastikan Anda sudah membuat view ini
                ->with([
                    'visitorName' => $this->visitor->pic_name,
                    'status' => $this->status,
                ]);
}

}
