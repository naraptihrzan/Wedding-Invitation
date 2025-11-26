@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 fw-bold">Daftar RSVP</h2>

    {{-- Tombol Tambah Tamu --}}
    <a href="{{ route('dashboardadmin.create') }}" class="btn btn-primary mb-3">
        Tambah Tamu
    </a>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>HP</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($guests as $guest)
                        <tr>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->phone }}</td>

                            <td>
                                @if ($guest->rsvp_status === 'coming')
                                    <span class="badge bg-success">Hadir</span>
                                @else
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('dashboardadmin.show', $guest->id) }}" 
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('dashboardadmin.edit', $guest->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('dashboardadmin.destroy', $guest->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus data?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $guests->links() }}
    </div>

</div>
@endsection
