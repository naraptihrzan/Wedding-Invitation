@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Edit Tamu</h2>

    <form action="{{ route('dashboardadmin.update', $guest->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $guest->name }}" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ $guest->email }}" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="phone" value="{{ $guest->phone }}" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Status RSVP</label>
            <select name="rsvp_status" class="form-control" required>
                <option value="coming" {{ $guest->rsvp_status === 'coming' ? 'selected' : '' }}>Hadir</option>
                <option value="not_coming" {{ $guest->rsvp_status === 'not_coming' ? 'selected' : '' }}>Tidak Hadir</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Update</button>
    </form>

</div>
@endsection
