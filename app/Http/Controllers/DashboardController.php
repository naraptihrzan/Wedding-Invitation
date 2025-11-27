<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /** List tamu */
    public function index()
    {
        $guests = Guest::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.index', compact('guests'));
    }

    /** Form tambah tamu */
    public function create()
    {
        return view('dashboard.create');
    }

    /** Simpan tamu baru */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:guests',
            'phone' => 'required',
            'rsvp_status' => 'required|in:coming,not_coming'
        ]);

        Guest::create($request->all());

        return redirect()->route('dashboardadmin.index')
            ->with('success', 'Data tamu berhasil ditambahkan!');
    }

    /** Detail tamu */
    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return view('dashboard.show', compact('guest'));
    }

    /** Form edit */
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('dashboard.edit', compact('guest'));
    }

    /** Update tamu */
    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:guests,email,$id",
            'phone' => 'required',
            'rsvp_status' => 'required|in:coming,not_coming'
        ]);

        $guest->update($request->all());

        return redirect()->route('dashboardadmin.index')
            ->with('success', 'Data tamu berhasil diperbarui!');
    }

    /** Hapus tamu */
    public function destroy($id)
    {
        Guest::findOrFail($id)->delete();

        return redirect()->route('dashboardadmin.index')
            ->with('success', 'Data tamu berhasil dihapus!');
    }
}
