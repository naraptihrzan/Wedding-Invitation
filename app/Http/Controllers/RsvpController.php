<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Jobs\GenerateVoucherJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RsvpController extends Controller
{
    /**
     * Menyimpan data RSVP
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:guests,email',
            'phone' => 'required|string|max:20',
            'rsvp_status' => 'required|in:coming,not_coming',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->to(url()->previous() . '#rsvp')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Simpan data tamu
        $guest = Guest::create($request->all());

        // Jika tamu konfirmasi "Hadir", panggil Job
        if ($guest->rsvp_status == 'coming') {
            GenerateVoucherJob::dispatch($guest);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Terima kasih telah melakukan RSVP! QR Code akan dikirim via Email & WhatsApp.'], 200);
        }

        return redirect()->to(url()->previous() . '#rsvp')
                    ->with('success', 'Terima kasih telah melakukan RSVP!');
    }
}

