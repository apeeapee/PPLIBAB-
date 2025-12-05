<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Laporan' }} - kampuStore</title>
    <style>
        * {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
            color: #1a202c;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #f97316;
            background: linear-gradient(135deg, #fff7ed 0%, #ffffff 100%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .header h1 {
            color: #f97316;
            font-size: 28px;
            margin: 0 0 5px 0;
            font-weight: 800;
        }
        .header h2 {
            color: #374151;
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 8px 0;
        }
        .header p {
            color: #6b7280;
            font-size: 11px;
            margin: 0;
        }
        .info-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f97316;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .info-box p {
            margin: 4px 0;
            font-size: 11px;
        }
        .info-box strong {
            color: #111827;
            font-weight: 600;
        }
        .srs-reference {
            background: #fff7ed;
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 10px;
            color: #9a3412;
            text-align: center;
            border: 1px dashed #fed7aa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        table th {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: #fff;
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #ea580c;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
            border-right: 1px solid #f3f4f6;
        }
        table tr:last-child td {
            border-bottom: 2px solid #f97316;
        }
        table tr:nth-child(even) {
            background: #f9fafb;
        }
        table tr:hover {
            background: #fff7ed;
        }
        table tr:nth-child(even):hover {
            background: #fed7aa;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .badge-success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 1px solid #86efac;
        }
        .badge-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        .badge-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        .badge-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border: 1px solid #93c5fd;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #f97316;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            background: linear-gradient(135deg, #fff7ed 0%, #ffffff 100%);
            padding: 20px;
            border-radius: 8px;
        }
        .page-break {
            page-break-before: always;
        }
        .stats-row {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-spacing: 10px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #f97316;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .stat-box .value {
            font-size: 28px;
            font-weight: 800;
            color: #f97316;
            margin-bottom: 5px;
        }
        .stat-box .label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        .highlight-row {
            background: linear-gradient(90deg, #fff7ed 0%, #ffffff 100%) !important;
            border-left: 4px solid #f97316;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
            font-size: 14px;
        }
        @media print {
            body { margin: 0; padding: 15px; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>kampuStore</h1>
        <h2>{{ $title ?? 'Laporan' }}</h2>
        <p>Marketplace Mahasiswa UNDIP</p>
        <p><strong>Dicetak pada:</strong> {{ now()->format('d F Y H:i') }} WIB</p>
    </div>

    @yield('content')

    <div class="footer">
        <p><strong>&copy; {{ date('Y') }} kampuStore - Marketplace Mahasiswa UNDIP</strong></p>
        <p>Laporan ini digenerate secara otomatis oleh sistem pada {{ now()->format('d F Y H:i:s') }}</p>
        <p>Keterangan: Hanya dokumen resmi dari sistem kampuStore yang dianggap valid</p>
    </div>
</body>
</html>
