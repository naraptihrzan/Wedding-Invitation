@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Tambah Tamu Baru</h2>

    <form action="{{ route('dashboardadmin.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Status RSVP</label>
            <select name="rsvp_status" class="form-control" required>
                <option value="coming">Hadir</option>
                <option value="not_coming">Tidak Hadir</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Simpan</button>
    </form>

</div>
@endsection
