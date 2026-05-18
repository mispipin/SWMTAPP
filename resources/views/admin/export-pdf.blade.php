<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Pendaftar SWMT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
        .chip {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            background: #e1f5fe;
            color: #01579b;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/Logo.png') }}" style="width: 70px; height: auto; margin-bottom: 10px;">
        <h1>Laporan Data Siswa</h1>
        <p>Spatial Working Memory Test (SWMT) - {{ isset($isSuperAdmin) && $isSuperAdmin ? 'Global Dashboard' : 'Dashboard Guru' }}</p>
        @if(isset($className))
            <p><strong>Filter Kelas: {{ $className }}</strong></p>
        @endif
        <p>Dicetak pada: {{ now()->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                @if(isset($isSuperAdmin) && $isSuperAdmin)
                    <th>Guru Pengampu</th>
                @endif
                <th>NAMA SISWA</th>
                <th>Asal Sekolah</th>
                <th>Kelas</th>
                <th>Tgl Lahir</th>
                <th>Skor</th>
                <th>Waktu Test</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $index => $reg)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    @if(isset($isSuperAdmin) && $isSuperAdmin)
                        <td>{{ $reg->teacherClass && $reg->teacherClass->teacher ? $reg->teacherClass->teacher->name : '-' }}</td>
                    @endif
                    <td>{{ $reg->name }}</td>
                    <td>{{ $reg->school }}</td>
                    <td>{{ $reg->class_name }}</td>
                    <td>{{ $reg->birth_date ? $reg->birth_date->format('d-m-Y') : '-' }}</td>
                    <td style="text-align: center;">
                        @if(!is_null($reg->total_poin))
                            <strong>{{ $reg->total_poin }}</strong>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $reg->tested_at ? $reg->tested_at->format('d-m-Y H:i') : 'Belum Test' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Halaman 1 dari 1 | &copy; {{ date('Y') }} - Spatial Working Memory Test
    </div>
</body>
</html>
