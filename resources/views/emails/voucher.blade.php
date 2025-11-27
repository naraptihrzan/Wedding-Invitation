<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Voucher</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: normal;
            letter-spacing: 2px;
        }
        
        .header .subtitle {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 3px;
            opacity: 0.95;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .greeting strong {
            color: #667eea;
            font-size: 20px;
        }
        
        .message {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 35px;
            text-align: justify;
        }
        
        .voucher-box {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            border: 3px dashed #ff8a65;
        }
        
        .discount {
            font-size: 48px;
            font-weight: bold;
            color: #d84315;
            margin-bottom: 10px;
        }
        
        .discount-label {
            font-size: 16px;
            color: #5d4037;
            font-weight: 600;
        }
        
        .qr-section {
            text-align: center;
            margin: 30px 0;
        }
        
        .qr-instruction {
            font-size: 15px;
            color: #666;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .qr-code {
            display: inline-block;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid #e0e0e0;
        }
        
        .qr-code img {
            display: block;
            width: 200px;
            height: 200px;
            border-radius: 10px;
        }
        
        .footer {
            background: #f5f5f5;
            padding: 30px;
            text-align: center;
            border-top: 3px solid #667eea;
        }
        
        .closing {
            font-size: 18px;
            color: #667eea;
            font-style: italic;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .copyright {
            font-size: 13px;
            color: #999;
            margin-top: 15px;
        }
        
        .divider {
            width: 60px;
            height: 3px;
            background: #667eea;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Wedding Invitation</h1>
            <div class="subtitle">EXCLUSIVE VOUCHER</div>
        </div>
        
        <div class="content">
            <div class="greeting">
                Halo, <strong>{{ $guest->name }}</strong>
            </div>
            
            <div class="message">
                Terima kasih telah melakukan RSVP untuk acara pernikahan kami. Sebagai bentuk apresiasi, kami mempersembahkan voucher diskon spesial untuk merchandise pernikahan.
            </div>
            
            <div class="voucher-box">
                <div class="discount">10%</div>
                <div class="discount-label">DISKON SPESIAL</div>
            </div>
            
            <div class="divider"></div>
            
            <div class="qr-section">
                <div class="qr-instruction">
                    Tunjukkan QR Code di bawah ini kepada tim merchandise kami untuk menukarkan voucher
                </div>
                
                <div class="qr-code">
                    <img src="{{ $message->embedData($qrBinary, 'voucher-qr.png') }}" alt="Voucher QR Code">
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="closing">
                Sampai jumpa di hari bahagia kami! ✨
            </div>
            <div class="divider"></div>
            <div class="copyright">
                © {{ date('Y') }} Wedding Invitation. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>