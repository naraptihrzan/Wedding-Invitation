<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tamu - Dashboard Admin</title>
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
            max-width: 800px;
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

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.95rem;
            box-sizing: border-box; /* Important for width: 100% */
            transition: border-color 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
        .btn-success {
            background-color: #059669;
            color: white;
        }
        .btn-success:hover { background-color: #047857; }
        
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            margin-right: 0.5rem;
        }
        .btn-secondary:hover { background-color: #4b5563; }

        .btn-container {
            margin-top: 2rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
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
            <h2>Tambah Tamu Baru</h2>

            <form action="{{ route('dashboardadmin.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required placeholder="Masukkan nama tamu">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label>No HP (WhatsApp)</label>
                    <input type="text" name="phone" class="form-control" required placeholder="08123456789">
                </div>

                <div class="form-group">
                    <label>Status RSVP Awal</label>
                    <select name="rsvp_status" class="form-control" required>
                        <option value="coming">Hadir</option>
                        <option value="not_coming">Tidak Hadir</option>
                    </select>
                </div>

                <div class="btn-container">
                    <a href="{{ route('dashboardadmin.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
