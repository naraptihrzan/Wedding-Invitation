<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Guest;
use App\Jobs\GenerateVoucherJob;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing'); 
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:guests,email',
        'phone' => 'required|string|max:20',
        'rsvp_status' => 'required|in:coming,not_coming',
    ]);

    // === HANDLE AJAX VALIDATION ERROR ===
    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        return redirect()->route('landing')
            ->withErrors($validator)
            ->withInput();
    }

    // Simpan data tamu
    $guest = Guest::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'phone'       => $request->phone,
        'rsvp_status' => $request->rsvp_status,
    ]);

    // === BALAS AJAX DULUAN ===
    

    // Generate voucher bila "coming"
    if ($guest->rsvp_status === 'coming') {
        GenerateVoucherJob::dispatch($guest);
    }

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'RSVP berhasil!'
        ]);
    }

    return redirect()->route('landing')
        ->with('success', 'Terima kasih telah melakukan RSVP!');
}

}
