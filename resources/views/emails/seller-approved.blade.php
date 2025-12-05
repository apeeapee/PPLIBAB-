<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Toko Anda Disetujui</title>
    <style>
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        
        .header {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .content {
            padding: 30px;
            background-color: #f9fafb;
            border-radius: 10px;
            margin-top: 20px;
            border: 1px solid #e5e7eb;
        }
        
        .button {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
            transition: transform 0.2s;
        }
        
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(76, 175, 80, 0.4);
        }
        
        .info-box {
            background-color: #ffffff;
            border-left: 4px solid #4CAF50;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .info-box ul {
            margin: 10px 0 0 0;
            padding-left: 20px;
        }
        
        .info-box li {
            margin: 8px 0;
            color: #4b5563;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
        
        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #f9fafb;
            }
            
            .content {
                background-color: #1f2937;
                border-color: #374151;
            }
            
            .info-box {
                background-color: #111827;
                border-color: #4CAF50;
            }
            
            .info-box li {
                color: #d1d5db;
            }
            
            .footer {
                border-top-color: #374151;
                color: #9ca3af;
            }
            
            p, strong {
                color: #f9fafb;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat! Toko Anda Disetujui</h1>
    </div>
    
    <div class="content">
        <p>Halo, <strong>{{ $seller->nama_pic }}</strong> 👋</p>
        
        <p>Selamat! Pendaftaran toko <strong>{{ $seller->nama_toko }}</strong> Anda telah disetujui oleh admin KampuStore. 🎉</p>
        
        <p>Anda sekarang dapat mulai mengelola toko dan mengunggah produk Anda.</p>
        
        <p style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">🚀 Aktifkan Akun & Kelola Toko</a>
        </p>
        
        <div class="info-box">
            <p style="margin-top: 0;"><strong>📋 Informasi Toko Anda:</strong></p>
            <ul>
                <li><strong>Nama Toko:</strong> {{ $seller->nama_toko }}</li>
                <li><strong>PIC:</strong> {{ $seller->nama_pic }}</li>
                <li><strong>Email:</strong> {{ $seller->email_pic }}</li>
                <li><strong>Lokasi:</strong> {{ $seller->kota }}</li>
            </ul>
        </div>
        
        <p>Terima kasih telah bergabung dengan KampuStore! Kami senang Anda bergabung dengan komunitas kami. 💚</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>
</html>
