<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tamu - Dashboard Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }
        
        /* Navbar */
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
        .nav-link:hover { color: #2563eb; }

        /* Container */
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* Card */
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        /* Typography */
        h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: #111827;
            font-size: 1.5rem;
        }

        /* Detail List */
        .detail-item {
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 0.9rem;
        }
        .detail-value {
            font-weight: 500;
            color: #111827;
            font-size: 1rem;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
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

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            border: none;
            font-size: 0.95rem;
            transition: background-color 0.2s;
        }
        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }
        .btn-secondary:hover { background-color: #4b5563; }
        
        .btn-warning {
            background-color: #eab308;
            color: white;
        }
        .btn-warning:hover { background-color: #ca8a04; }

        .btn-container {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('dashboardadmin.index') }}" class="navbar-brand">Wedding Admin</a>
        <div class="navbar-nav">
            <a href="{{ route('dashboardadmin.index') }}" class="nav-link">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Detail Tamu</h2>

            <div class="detail-list">
                <div class="detail-item">
                    <span class="detail-label">Nama Lengkap</span>
                    <span class="detail-value">{{ $guest->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $guest->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">No HP</span>
                    <span class="detail-value">{{ $guest->phone }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status RSVP</span>
                    <span class="detail-value">
                        @if($guest->rsvp_status === 'coming')
                            <span class="badge badge-success">Hadir</span>
                        @else
                            <span class="badge badge-danger">Tidak Hadir</span>
                        @endif
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Terdaftar Sejak</span>
                    <span class="detail-value">{{ $guest->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ route('dashboardadmin.index') }}" class="btn btn-secondary">&larr; Kembali</a>
                <a href="{{ route('dashboardadmin.edit', $guest->id) }}" class="btn btn-warning">Edit Data</a>
            </div>
        </div>
    </div>

</body>
</html>
