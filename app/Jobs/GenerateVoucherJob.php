<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Models\Voucher;
use App\Mail\VoucherNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

class GenerateVoucherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guest;

    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    public function handle(): void
    {
        try {

            // Jika sudah ada voucher, skip
            if ($this->guest->voucher) {
                Log::info("{$this->guest->email} sudah memiliki voucher.");
                return;
            }

            // Generate kode voucher
            $code = 'WEDD-VOUCHER-' . Str::upper(Str::random(10));

            // Simpan voucher ke database
            $voucher = Voucher::create([
                'guest_id' => $this->guest->id,
                'code'     => $code,
                'status'   => 'unused',
            ]);

            /**
             * ====================================================
             * QR CODE GENERATOR
             * ====================================================
             */

            $fileName = 'qr_' . $voucher->code . '.png';
            $filePath = storage_path('app/public/' . $fileName);

            $qrResult = Builder::create()
                ->writer(new PngWriter())
                ->data($voucher->code)
                ->encoding(new Encoding('UTF-8'))
                ->size(300)
                ->margin(10)
                ->build();

            // Simpan QR ke storage/public
            file_put_contents($filePath, $qrResult->getString());

            // URL publik untuk WhatsApp
            $qrUrl = asset('storage/' . $fileName);

            // Base64 untuk email
            $qrBase64 = 'data:image/png;base64,' . base64_encode($qrResult->getString());

            /**
             * ====================================================
             * KIRIM EMAIL
             * ====================================================
             */

            Mail::to($this->guest->email)
                ->send(new VoucherNotification($this->guest, $qrBase64));

            /**
             * ====================================================
             * KIRIM WHATSAPP
             * ====================================================
             */

            $this->sendWhatsApp($this->guest, $qrUrl);

            Log::info("Voucher {$code} berhasil dibuat dan dikirim ke {$this->guest->email}.");

        } catch (\Exception $e) {

            Log::error("Gagal membuat voucher untuk {$this->guest->email}: {$e->getMessage()}");
        }
    }

    /**
     * ====================================================
     * SEND WHATSAPP VIA FONNTE API
     * ====================================================
     */
    protected function sendWhatsApp(Guest $guest, string $qrUrl)
    {
        $apiKey = config('services.fonnte.api_key');
        $phone = ltrim($guest->phone, '+'); // Bersihkan format nomor

        $caption = "Halo {$guest->name}, terima kasih telah melakukan RSVP.
Berikut voucher diskon 10% Anda. Silakan tunjukkan QR Code berikut kepada vendor.";

        try {

            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->withOptions([
                'verify' => false, // Disable SSL verification for local dev
            ])->post('https://api.fonnte.com/send', [
                'target'  => $phone,
                'message' => $caption,
                'url'     => $qrUrl, // Kirim QR sebagai image
            ]);

            if ($response->successful()) {
                Log::info("Fonnte: Pesan terkirim ke {$phone}");
            } else {
                Log::error("Fonnte error ({$phone}): " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Fonnte exception: {$e->getMessage()}");
        }
    }
}
