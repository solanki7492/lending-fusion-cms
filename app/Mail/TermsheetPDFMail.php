<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TermsheetPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdfContent;
    Protected $name;
    Protected $fileName;

    public function __construct($pdfContent ,$lead, $fileName)
    {
        $this->pdfContent = $pdfContent;
        $this->name = $lead->last_name;
        $this->fileName = $fileName;
    }

    public function build()
    {
        // Send the email with no body and the PDF attached
        return $this->subject('Congratulation on Your business Credit Approval!')
                    ->view('termsheet.mail')
                    ->with([
                        'name' => $this->name,
                        'pdfContent' => $this->pdfContent,
                    ])
                    ->attachData($this->pdfContent, $this->fileName, [
                        'mime' => 'application/pdf',
                    ]);
    }
}