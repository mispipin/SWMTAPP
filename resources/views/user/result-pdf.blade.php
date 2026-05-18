<!DOCTYPE html>
<html>
<head>
    <title>Hasil Test SWMT - {{ $registration->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a2138;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #6366f1;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #6366f1;
        }
        .header p {
            margin: 5px 0 0;
            color: #5f6877;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #5f6877;
            margin-bottom: 10px;
            border-left: 4px solid #6366f1;
            padding-left: 10px;
        }
        .info-grid {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-grid td {
            padding: 5px 0;
            vertical-align: top;
        }
        .label {
            width: 150px;
            font-weight: bold;
            color: #5f6877;
        }
        .result-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        .score {
            font-size: 32px;
            font-weight: bold;
            color: #6366f1;
            margin: 10px 0;
        }
        .category {
            display: inline-block;
            padding: 6px 16px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 999px;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .description {
            color: #5f6877;
            font-style: italic;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .stats-table th, .stats-table td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: center;
        }
        .stats-table th {
            background: #f1f5f9;
            color: #5f6877;
            font-size: 12px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/Logo.png') }}" style="width: 80px; height: auto; margin-bottom: 10px;">
        <h1>HASIL TEST SWMT</h1>
        <p>Spatial Working Memory Test - TUP X UMP</p>
        <p style="font-size: 11px; color: #7a869a; margin-top: 8px;">Dokumen ini diunduh pada: {{ now()->timezone('Asia/Jakarta')->format('d/m/Y H:i:s') }} WIB</p>
    </div>

    <div class="section">
        <div class="section-title">Informasi Peserta</div>
        <table class="info-grid">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>: {{ $registration->name }}</td>
            </tr>
            <tr>
                <td class="label">Asal Sekolah</td>
                <td>: {{ $registration->school }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: {{ $registration->class_name }}</td>
            </tr>
            <tr>
                <td class="label">Waktu Test</td>
                <td>: {{ $registration->tested_at ? $registration->tested_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Akhir</div>
        <div class="result-box">
            <div class="category">{{ $kategori }}</div>
            <div class="score">{{ $registration->total_poin }} Poin</div>
            <div class="description">"{{ $deskripsi }}"</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Rincian Statistik</div>
        <table class="stats-table">
            <thead>
                <tr>
                    <th>Orang Benar</th>
                    <th>Urutan Benar</th>
                    <th>Orang Salah</th>
                    <th>Urutan Salah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $registration->orang_benar }}</td>
                    <td>{{ $registration->urutan_benar }}</td>
                    <td>{{ $registration->orang_salah }}</td>
                    <td>{{ $registration->urutan_salah }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh Sistem SWMT (Spatial Working Memory Test).<br>
        &copy; {{ date('Y') }} - Spatial Working Memory Test
    </div>
</body>
</html>
