<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Pendaftaran Toko Ditolak</title>
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
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
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
        
        .reason-box {
            background-color: #ffffff;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .reason-box strong {
            color: #ef4444;
            font-size: 16px;
        }
        
        .reason-box p {
            margin: 10px 0 0 0;
            color: #4b5563;
            line-height: 1.8;
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
            
            .reason-box {
                background-color: #111827;
                border-color: #ef4444;
            }
            
            .reason-box p {
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
        <h1>Pendaftaran Toko Ditolak</h1>
    </div>
    
    <div class="content">
        <p>Halo, <strong>{{ $seller->nama_pic }}</strong> 👋</p>
        
        <p>Mohon maaf, pendaftaran toko <strong>{{ $seller->nama_toko }}</strong> Anda belum dapat disetujui oleh admin KampuStore saat ini.</p>
        
        <div class="reason-box">
            <strong>⚠️ Alasan Penolakan:</strong>
            <p>{{ $rejectionReason }}</p>
        </div>
        
        <p>Anda dapat memperbaiki data pendaftaran dan mengirimkan kembali permohonan pendaftaran toko setelah memenuhi persyaratan yang disebutkan di atas.</p>
        
        <p>Jika Anda memiliki pertanyaan atau memerlukan klarifikasi lebih lanjut, silakan hubungi admin KampuStore.</p>
        
        <p>Terima kasih atas pengertian Anda. Kami berharap dapat bekerja sama dengan Anda di masa mendatang. 🙏</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>
</html>
