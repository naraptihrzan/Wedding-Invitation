<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Wedding Invitation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }
        
        /* Header/Navbar */
        .navbar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            text-decoration: none;
        }
        .navbar-nav {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .nav-link {
            text-decoration: none;
            color: #4b5563;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: #2563eb;
        }
        .btn-logout {
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            padding: 0;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* Page Title & Actions */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .page-title {
            margin: 0;
            font-size: 1.5rem;
            color: #111827;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid transparent;
            transition: background-color 0.2s;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        .btn-info {
            background-color: #0ea5e9;
            color: white;
        }
        .btn-warning {
            background-color: #eab308;
            color: white;
        }
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        /* Card & Table */
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #f9fafb;
            text-align: left;
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 600;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }
        td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:last-child td {
            border-bottom: none;
        }
        
        /* Badges */
        .badge {
            display: inline-flex;
            padding: 0.125rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 1.5rem;
        }
        /* Simple override for Laravel pagination if it uses Tailwind classes by default, 
           or we might need to publish pagination views. For now, we assume basic rendering. */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 0.25rem;
        }
        .pagination li a, .pagination li span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            text-decoration: none;
            color: #374151;
            font-size: 0.875rem;
        }
        .pagination li.active span {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboardadmin.index') }}" class="navbar-brand">Wedding Admin</a>
        <div class="navbar-nav">
            <a href="{{ route('dashboardadmin.index') }}" class="nav-link active">Dashboard</a>
            <a href="{{ route('voucher.scan') }}" class="nav-link">Scan Voucher</a>
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link btn-logout">Log Out</button>
            </form>
        </div>
    </nav>

    <div class="container">
        
        <div class="page-header">
            <h2 class="page-title">Daftar RSVP</h2>
            <a href="{{ route('dashboardadmin.create') }}" class="btn btn-primary">
                + Tambah Tamu
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="card">
            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>HP</th>
                            <th>Status</th>
                            <th width="200">Aksi</th>
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
                                        <span class="badge badge-success">Hadir</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Hadir</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboardadmin.show', $guest->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('dashboardadmin.edit', $guest->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <form action="{{ route('dashboardadmin.destroy', $guest->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrapper">
            {{ $guests->links('pagination::bootstrap-4') }} 
            {{-- Menggunakan bootstrap-4 pagination view bawaan Laravel yang lebih mudah di-style atau cukup bersih --}}
        </div>

    </div>

</body>
</html>
