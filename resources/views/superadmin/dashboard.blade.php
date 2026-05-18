<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - SWMT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,500,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1a2138;
            --muted: #5f6877;
            --line: rgba(17, 24, 39, 0.1);
            --card: rgba(255, 255, 255, 0.88);
            --head: #f3f8fc;
            --accent: #6366f1; /* Different color for Super Admin */
            --success: #22c55e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Poppins, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 14%, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0) 34%),
                radial-gradient(circle at 86% 18%, rgba(248, 235, 153, 0.2), rgba(248, 235, 153, 0) 32%),
                #f2f3ee;
            padding: 26px 16px;
        }

        .wrap {
            width: min(1200px, 100%);
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: -0.02em;
        }

        .chip {
            display: inline-block;
            padding: 4px 12px;
            background: var(--accent);
            color: #fff;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card);
            padding: 24px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent);
        }

        .stat-icon span { font-size: 28px; }

        .stat-info h3 {
            margin: 0;
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 500;
        }

        .stat-info p {
            margin: 4px 0 0;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ink);
        }

        .card {
            background: var(--card);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.06);
            backdrop-filter: blur(8px);
            overflow: hidden;
        }

        .panel-header {
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--line);
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.25rem;
        }

        .search-form {
            display: flex;
            gap: 10px;
            max-width: 400px;
            width: 100%;
        }

        .search-input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.5);
            font-family: inherit;
        }

        .search-btn, .btn {
            padding: 10px 20px;
            border-radius: 12px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-success { background: var(--success); }

        .btn:hover { opacity: 0.9; transform: translateY(-1px); }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 1000px; }

        th {
            background: var(--head);
            padding: 14px 20px;
            text-align: left;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            font-size: 0.9rem;
        }

        .teacher-info {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .pagination-wrap {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrap ul {
            display: flex;
            list-style: none;
            gap: 8px;
            padding: 0;
        }

        .pagination-wrap li span, .pagination-wrap li a {
            display: block;
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid var(--line);
            text-decoration: none;
            color: var(--ink);
            font-weight: 600;
        }

        .pagination-wrap li.active span {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .empty { padding: 40px; text-align: center; color: var(--muted); }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Super Admin Dashboard</h1>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <a href="{{ route('teacher.profile.edit') }}" class="btn" style="background: rgba(0,0,0,0.05); color: var(--ink);">
                    <span class="material-symbols-rounded">manage_accounts</span> Profil
                </a>
                <form action="{{ route('teacher.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn" style="background: rgba(0,0,0,0.05); color: var(--ink);">
                        <span class="material-symbols-rounded">logout</span> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><span class="material-symbols-rounded">person</span></div>
                <div class="stat-info">
                    <h3>Total Guru</h3>
                    <p>{{ $totalTeachers }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);"><span class="material-symbols-rounded">groups</span></div>
                <div class="stat-info">
                    <h3>Total Kelas</h3>
                    <p>{{ $totalClasses }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;"><span class="material-symbols-rounded">school</span></div>
                <div class="stat-info">
                    <h3>Total Siswa</h3>
                    <p>{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
        
        @if (session('success'))
            <div class="stat-card" style="margin-bottom: 24px; background: rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.2); padding: 16px 24px;">
                <div class="stat-icon" style="background: var(--success); color: #fff; width: 32px; height: 32px;">
                    <span class="material-symbols-rounded" style="font-size: 1.2rem;">check_circle</span>
                </div>
                <p style="margin: 0; font-weight: 600; color: #166534; font-size: 0.95rem;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="card">
            <div class="panel-header">
                <h2>Seluruh Data Siswa</h2>
                <div style="display: flex; gap: 12px; align-items: center; flex: 1; justify-content: flex-end;">
                    <form class="search-form" action="{{ route('superadmin.dashboard') }}" method="get">
                        <input class="search-input" type="search" name="q" value="{{ $search }}" placeholder="Cari nama, sekolah, atau kelas">
                        <button class="search-btn" type="submit">Search</button>
                    </form>
                    <a href="{{ route('superadmin.export.pdf', ['q' => $search]) }}" class="btn btn-success">
                        <span class="material-symbols-rounded">picture_as_pdf</span> PDF
                    </a>
                </div>
            </div>

            @if ($registrations->isEmpty())
                <div class="empty">Tidak ada data pendaftar ditemukan.</div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Guru Pengampu</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Kelas</th>
                                <th>Tanggal Lahir</th>
                                <th>Skor</th>
                                <th>Waktu Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $index => $reg)
                                <tr>
                                    <td>{{ ($registrations->currentPage() - 1) * $registrations->perPage() + $index + 1 }}</td>
                                    <td>
                                        @if($reg->teacherClass && $reg->teacherClass->teacher)
                                            <strong>{{ $reg->teacherClass->teacher->name }}</strong>
                                            <div class="teacher-info">{{ $reg->teacherClass->name }}</div>
                                        @else
                                            <span style="color: var(--muted); font-style: italic;">Pendaftar Mandiri</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $reg->name }}</strong>
                                    </td>
                                    <td>{{ $reg->school }}</td>
                                    <td>{{ $reg->class_name }}</td>
                                    <td>{{ $reg->birth_date ? $reg->birth_date->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if($reg->total_poin !== null)
                                            <span style="font-weight: 700; color: var(--accent);">{{ $reg->total_poin }} poin</span>
                                        @else
                                            <span style="color: var(--muted);">Belum test</span>
                                        @endif
                                    </td>
                                    <td>{{ $reg->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('superadmin.registrations.destroy', $reg) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" style="background: rgba(220, 38, 38, 0.1); color: #dc2626; padding: 6px 12px; border-radius: 8px;">
                                                <span class="material-symbols-rounded" style="font-size: 1.1rem;">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrap">
                    {{ $registrations->appends(['q' => $search])->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
