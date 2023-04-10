<?php

namespace App\Jobs;

use App\Mail\TicketsMail;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tickets, $client;

    /**
     * Create a new job instance.
     */
    public function __construct(Client $client, array $tickets)
    {
        $this->client = $client;
        $this->tickets = $tickets;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->client->email)->send(new TicketsMail($this->client, $this->tickets));
    }
}
