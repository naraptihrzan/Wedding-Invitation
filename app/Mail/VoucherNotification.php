<?php

namespace App\Mail;

use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoucherNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Guest $guest;
    public string $qrCodeBase64;

    public function __construct(Guest $guest, string $qrCodeBase64)
    {
        $this->guest = $guest;
        $this->qrCodeBase64 = $qrCodeBase64;
    }

    public function build()
    {
        // decode base64 → binary PNG
        $binary = base64_decode(
            str_replace('data:image/png;base64,', '', $this->qrCodeBase64)
        );

        return $this->subject('Voucher Spesial Untuk Anda!')
            ->view('emails.voucher')
            ->with([
                'guest' => $this->guest,
                'qrBinary' => $binary,
            ]);
    }
}
