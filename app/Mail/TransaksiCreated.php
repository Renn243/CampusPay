<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Transaksi; 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransaksiCreated extends Mailable
{
    use SerializesModels;

    public $transaksi;

    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Admin Keuangan')
                    ->subject('Transaksi Anda Berhasil Dibuat')
                    ->view('emails.transaksi_created');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
