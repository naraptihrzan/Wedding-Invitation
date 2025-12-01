<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Voucher QR Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }
        .header {
            background-color: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 1.25rem;
            color: #111827;
        }
        .btn-back {
            text-decoration: none;
            color: #4b5563;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }
        .btn-back:hover {
            background-color: #f9fafb;
            color: #111827;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        #qr-reader {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            border: none !important;
        }
        #scan-result {
            margin-top: 1.5rem;
            text-align: center;
            font-weight: 500;
            font-size: 1.125rem;
        }
        .text-blue { color: #2563eb; }
        .text-green { color: #059669; }
        .text-red { color: #dc2626; }
        
        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
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
        .badge {
            display: inline-flex;
            padding: 0.125rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            background-color: #d1fae5;
            color: #065f46;
        }
        .btn-reload {
            background: none;
            border: none;
            color: #3b82f6;
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Scan Voucher QR Code</h1>
        <a href="{{ route('dashboardadmin.index') }}" class="btn-back">&larr; Kembali ke Dashboard</a>
    </div>

    <div class="container">
        <!-- Scanner Section -->
        <div class="card">
            <!-- Manual Input / Physical Scanner -->
            <div style="margin-bottom: 1.5rem; text-align: center;">
                <label for="manual-code" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Input Manual / Alat Scanner</label>
                <div style="display: flex; justify-content: center; gap: 0.5rem;">
                    <input type="text" id="manual-code" placeholder="Klik di sini lalu scan..." 
                        style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; width: 100%; max-width: 300px; font-size: 1rem;"
                        autofocus>
                    <button id="btn-manual-submit" class="btn-back" style="background-color: #2563eb; color: white; border: none; cursor: pointer;">
                        Cek
                    </button>
                </div>
                <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">
                    <em>Pastikan kursor aktif di kolom input saat menggunakan alat scanner.</em>
                </p>
            </div>

            <div id="qr-reader"></div>
            <div id="scan-result">
                Arahkan kamera ke QR Code Voucher...
            </div>
        </div>

        <!-- History Section -->
        <div class="card">
            <h3 style="margin-top: 0; margin-bottom: 1rem; font-size: 1.125rem; color: #111827;">Riwayat Scan Terbaru</h3>
            <div class="table-container">
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Waktu Scan</th>
                            <th>Nama Tamu</th>
                            <th>Kode Voucher</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentVouchers as $voucher)
                        <tr>
                            <td>{{ $voucher->used_at ? \Carbon\Carbon::parse($voucher->used_at)->timezone('Asia/Jakarta')->format('d M Y H:i') : '-' }} WIB</td>
                            <td style="font-weight: 500; color: #111827;">{{ $voucher->guest->name ?? 'Unknown' }}</td>
                            <td>{{ $voucher->code }}</td>
                            <td><span class="badge">Berhasil</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #6b7280;">Belum ada data scan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Load library scanner -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Html5QrcodeScanner === 'undefined') {
                alert('Error: Library QR Code Scanner gagal dimuat. Periksa koneksi internet Anda.');
                return;
            }

            const resultContainer = document.getElementById('scan-result');
            
            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Scan berhasil: ${decodedText}`);
                html5QrcodeScanner.clear();
                resultContainer.innerHTML = `<span class="text-blue">Memvalidasi kode ${decodedText}...</span>`;
                redeemVoucher(decodedText);
            }

            function onScanError(errorMessage) {
                // console.warn(`Scan error: ${errorMessage}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", 
                { 
                    fps: 20, // Scan lebih cepat
                    qrbox: 250, // Kotak scan
                    disableFlip: false,
                    aspectRatio: 1.0,
                    experimentalFeatures: {
                        useBarCodeDetectorIfSupported: true
                    }
                }, 
                false
            );
            
            html5QrcodeScanner.render(onScanSuccess, onScanError);

            async function redeemVoucher(code) {
                try {
                    const response = await fetch("{{ route('voucher.redeem') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ code: code })
                    });

                    const result = await response.json();

                    if (response.ok) {
                        resultContainer.innerHTML = `<span class="text-green">${result.message}</span>`;
                    } else {
                        resultContainer.innerHTML = `<span class="text-red">${result.error}</span>`;
                    }

                } catch (error) {
                    console.error('Fetch error:', error);
                    resultContainer.innerHTML = `<span class="text-red">Error: Gagal terhubung ke server.</span>`;
                }

                resultContainer.innerHTML += ` <button onclick="window.location.reload()" class="btn-reload">Scan Lagi</button>`;
            }
            // Handle Manual Input / Physical Scanner
            const manualInput = document.getElementById('manual-code');
            const manualBtn = document.getElementById('btn-manual-submit');

            function handleManualSubmit() {
                const code = manualInput.value.trim();
                if (code) {
                    resultContainer.innerHTML = `<span class="text-blue">Memvalidasi kode ${code}...</span>`;
                    redeemVoucher(code);
                    manualInput.value = ''; // Clear input after submit
                    manualInput.focus(); // Refocus for next scan
                }
            }

            manualBtn.addEventListener('click', handleManualSubmit);

            manualInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    handleManualSubmit();
                }
            });

            // Auto-focus input on load
            manualInput.focus();
        });
    </script>
</body>
</html>

