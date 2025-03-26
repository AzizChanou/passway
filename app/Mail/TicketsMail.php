<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Mail\Attachment;
use Illuminate\Support\Facades\Storage;

class TicketsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tickets, $client;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, array $tickets)
    {
        $this->client = $client;
        $this->tickets = $tickets;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Achat de ticket(s) - ' . env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.tickets-mail',
            with: [$this->client, $this->tickets]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $writer = new PngWriter();
        $tickets = [];
        $i = 1;

        $logo = Logo::create(public_path('assets/img/logo_dark.png'))
            ->setResizeToWidth(100);

        foreach ($this->tickets as $ticket) {
            $qr_code = QrCode::create($ticket->code)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(400)
                ->setMargin(10)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));

            $image_content = $writer->write($qr_code, $logo);

            Storage::put('public/qrcodes/' . $this->client->name . '_' . $i . '.png', $image_content->getString());

            $attachment =  Attachment::fromData(fn () => $image_content->getString(), $this->client->name . '_' . $i++ . '.png')
                ->withMime($image_content->getMimeType());

            array_push($tickets, $attachment);
        }
        return $tickets;
    }
}
