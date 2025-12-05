<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Laporan' }} - kampuStore</title>
    <style>
        /* Standard Corporate PDF Styling */
        * {
            font-family: 'Helvetica Neue', 'Arial', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 11px;
            line-height: 1.4;
            color: #2c3e50;
            background: #ffffff;
        }

        .page {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm 20mm;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e40af;
        }

        .header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header h2 {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header-info-item {
            text-align: center;
        }

        .header-info-label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
        }

        .header-info-value {
            font-size: 12px;
            color: #1e293b;
            font-weight: 700;
            margin-top: 2px;
        }

        .metadata-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .metadata-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
        }

        .metadata-item {
            display: flex;
            flex-direction: column;
        }

        .metadata-label {
            font-size: 9px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .metadata-value {
            font-size: 11px;
            color: #1e293b;
            font-weight: 500;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e40af;
            margin: 25px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        table th {
            background: #1e40af !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            padding: 12px 8px;
            text-align: center;
            letter-spacing: 0.5px;
            border: 2px solid #ffffff !important;
            vertical-align: middle;
        }

        table th:last-child {
            border-right: 1px solid #ffffff;
        }

        table td {
            font-size: 10px;
            padding: 10px 8px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            vertical-align: middle;
            color: #1e293b;
        }

        table td:last-child {
            border-right: none;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:nth-child(even) {
            background: #fafafa;
        }

        table tr:hover {
            background: #f0f9ff;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .highlight-row {
            background: #f0f9ff !important;
            border-left: 3px solid #1e40af;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
            font-style: italic;
            font-size: 12px;
        }

        .summary-box {
            background: #f0f9ff;
            border: 1px solid #3b82f6;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }

        .summary-title {
            font-size: 12px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
        }

        .summary-item {
            text-align: center;
            padding: 10px;
            background: #ffffff;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .summary-value {
            font-size: 18px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 2px;
        }

        .summary-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #64748b;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .page-break {
            page-break-before: always;
        }

        .warning-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 12px;
            margin: 15px 0;
        }

        .warning-box p {
            color: #991b1b;
            font-weight: 500;
            margin: 0;
        }

        @media print {
            body { margin: 0; padding: 0; }
            .page { margin: 0; padding: 10mm 15mm; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>kampuStore</h1>
            <h2>{{ $title ?? 'Laporan' }}</h2>
            <div class="header-info" style="display: flex; justify-content: space-between; width: 100%;">
                <div class="header-info-item" style="text-align: left;">
                    <div class="header-info-label">Dicetak</div>
                    <div class="header-info-value">{{ isset($generatedDate) ? $generatedDate->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}</div>
                </div>
                <div class="header-info-item" style="text-align: right;">
                    <div class="header-info-label">User</div>
                    <div class="header-info-value">{{ $user ?? 'Admin KampuStore' }}</div>
                </div>
            </div>
        </div>

        @yield('content')

        <div class="footer">
            <div class="footer-row">
                <div>&copy; {{ date('Y') }} kampuStore - Marketplace Mahasiswa UNDIP</div>
                <div>Laporan Resmi Sistem</div>
            </div>
            <div class="footer-row">
                <div>Dokumen ini dicetak secara otomatis oleh sistem</div>
                <div>Generated: {{ now()->format('d F Y H:i:s') }}</div>
            </div>
            <div style="margin-top: 5px;">
                <em>Hanya dokumen yang dicetak langsung dari sistem yang dianggap valid</em>
            </div>
        </div>
    </div>
</body>
</html>