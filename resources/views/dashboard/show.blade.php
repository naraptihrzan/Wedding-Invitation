@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Detail Tamu</h2>

    <div class="card mt-3 p-3">
        <p><strong>Nama:</strong> {{ $guest->name }}</p>
        <p><strong>Email:</strong> {{ $guest->email }}</p>
        <p><strong>Telepon:</strong> {{ $guest->phone }}</p>
        <p><strong>Status:</strong> 
            @if($guest->rsvp_status === 'coming')
                <span class="badge bg-success">Hadir</span>
            @else
                <span class="badge bg-danger">Tidak Hadir</span>
            @endif
        </p>
    </div>

    <a href="{{ route('dashboardadmin.index') }}" class="btn btn-secondary mt-3">Kembali</a>

</div>
@endsection
