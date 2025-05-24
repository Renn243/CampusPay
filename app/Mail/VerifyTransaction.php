<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\TagihanMahasiswa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyTransaction extends Mailable
{
    use SerializesModels;

    public $tagihan;

    public function __construct(TagihanMahasiswa $tagihan)
    {
        $this->tagihan = $tagihan;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Admin Keuangan')
            ->subject('Transaksi anda sudah di verifikasi')
            ->view('emails.verify_transaction');
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
