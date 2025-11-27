<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherScanController extends Controller
{
    /**
     * Menampilkan halaman scanner
     */
    public function index()
    {
        $recentVouchers = \App\Models\Voucher::with('guest')
            ->where('status', 'used')
            ->orderBy('used_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.scan', compact('recentVouchers'));
    }
}
