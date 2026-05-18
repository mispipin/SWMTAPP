<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SWMT</title>
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
            --accent: #0f86c3;
            --success: #22c55e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Poppins, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 14%, rgba(151, 215, 244, 0.52), rgba(151, 215, 244, 0) 34%),
                radial-gradient(circle at 86% 18%, rgba(248, 235, 153, 0.56), rgba(248, 235, 153, 0) 32%),
                #f2f3ee;
            padding: 26px 16px;
        }

        .wrap {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.25rem, 2.4vw, 1.8rem);
            line-height: 1.1;
        }

        .meta {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 12px;
            text-decoration: none;
            border-radius: 999px;
            border: 1px solid var(--line);
            color: #33435f;
            background: rgba(255, 255, 255, 0.74);
            font-weight: 500;
            font-size: 0.88rem;
            cursor: pointer;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card {
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.42);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 22px 56px rgba(24, 35, 51, 0.12);
            backdrop-filter: blur(8px);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1180px;
        }

        th,
        td {
            text-align: left;
            padding: 13px 14px;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--line);
            vertical-align: top;
            line-height: 1.45;
        }

        th {
            background: var(--head);
            color: #324362;
            font-weight: 600;
        }

        tbody tr:hover {
            background: rgba(15, 134, 195, 0.06);
        }

        .empty {
            padding: 22px 16px;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            font-size: 1rem;
            line-height: 1;
        }

        .chip {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #0c6a97;
            background: rgba(15, 134, 195, 0.14);
            white-space: nowrap;
        }

        .col-no,
        .col-kelas,
        .col-poin,
        .col-waktu-test,
        .col-waktu-daftar,
        .col-aksi {
            text-align: center;
        }

        .col-tgl-lahir,
        .col-waktu-test,
        .col-waktu-daftar {
            white-space: nowrap;
        }

        .col-kelas {
            width: 70px;
        }

        .col-no {
            width: 52px;
        }

        .col-aksi {
            width: 150px;
        }

        .col-poin {
            width: 120px;
        }

        .col-tgl-lahir {
            width: 130px;
        }

        .actions-cell {
            justify-content: center;
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 360px) minmax(0, 1fr);
            gap: 14px;
            margin-bottom: 14px;
        }

        .panel {
            padding: 16px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .panel h2 {
            margin: 0;
            font-size: 1rem;
        }

        .class-form {
            display: grid;
            gap: 10px;
        }

        .class-input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 10px 14px;
            font: inherit;
            outline: none;
            background: rgba(255, 255, 255, 0.82);
        }

        .class-input:focus {
            border-color: rgba(15, 134, 195, 0.45);
            box-shadow: 0 0 0 3px rgba(15, 134, 195, 0.12);
        }

        .class-submit {
            border: 0;
            border-radius: 999px;
            padding: 10px 14px;
            background: linear-gradient(180deg, #1493d2 0%, #0f86c3 100%);
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        .class-list {
            display: grid;
            gap: 10px;
        }

        .class-item {
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(15, 134, 195, 0.06);
            border: 1px solid rgba(15, 134, 195, 0.12);
        }

        .class-item-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .class-actions {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.86);
            color: #33435f;
            cursor: pointer;
            text-decoration: none;
        }

        .icon-btn.copy {
            color: #0b6f9b;
        }

        .icon-btn.delete {
            color: #8e2432;
        }

        .class-code {
            display: inline-block;
            margin-top: 6px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(15, 134, 195, 0.14);
            color: #0c6a97;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .class-item.is-active {
            border-color: var(--accent);
            background: rgba(15, 134, 195, 0.12);
            box-shadow: 0 4px 12px rgba(15, 134, 195, 0.08);
        }

        .icon-btn.view.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .search-form {
            display: flex;
            gap: 8px;
            align-items: center;
            flex: 1 1 auto;
            max-width: 420px;
        }

        @media (max-width: 920px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .search-input {
            width: 100%;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.82);
            border-radius: 999px;
            padding: 10px 14px;
            font: inherit;
            color: var(--ink);
            outline: none;
        }

        .search-input:focus {
            border-color: rgba(15, 134, 195, 0.45);
            box-shadow: 0 0 0 3px rgba(15, 134, 195, 0.12);
        }

        .search-btn {
            border: 0;
            border-radius: 999px;
            padding: 10px 14px;
            background: linear-gradient(180deg, #1493d2 0%, #0f86c3 100%);
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .search-clear {
            text-decoration: none;
            color: #51627d;
            font-size: 0.86rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .alert {
            margin: 0 0 14px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            line-height: 1.4;
            color: #0f6a37;
            background: rgba(25, 170, 88, 0.14);
            border: 1px solid rgba(25, 170, 88, 0.28);
        }

        .actions-cell {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .actions-cell form {
            margin: 0;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
            min-width: 102px;
            padding: 7px 10px;
            border-radius: 999px;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
        }

        .action-btn.edit {
            color: #0b6f9b;
            background: rgba(15, 134, 195, 0.12);
            border-color: rgba(15, 134, 195, 0.22);
        }

        .action-btn.delete {
            color: #8e2432;
            background: rgba(220, 64, 64, 0.12);
            border-color: rgba(220, 64, 64, 0.22);
        }

        @media (max-width: 720px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .search-form {
                max-width: none;
                width: 100%;
            }

            .toolbar {
                gap: 10px;
            }

            .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .search-btn,
            .search-clear,
            .back {
                width: 100%;
                justify-content: center;
            }

            .actions-cell {
                align-items: center;
                justify-content: center;
            }

            .action-btn {
                min-width: 96px;
            }
        }

        @media (max-width: 560px) {
            body { padding: 18px 12px; }
            .topbar { margin-bottom: 12px; }
            h1 { font-size: 1.2rem; }
            .meta { font-size: 0.85rem; }
            .card { border-radius: 12px; }
            th,
            td { padding: 11px 12px; font-size: 0.84rem; }
            .search-input { padding: 9px 12px; }
        }

        /* Custom Pagination */
        .pagination-wrap {
            margin-top: 16px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrap ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination-wrap li {
            list-style: none;
            margin: 0;
        }

        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 10px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid var(--line);
            color: #33435f;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .pagination-wrap .active span {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(15, 134, 195, 0.24);
        }

        .pagination-wrap .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-wrap a:hover {
            background: rgba(15, 134, 195, 0.08);
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <main class="wrap">
        <div class="topbar">
            <div>
                <h1>Dashboard Guru</h1>
                <p class="meta">Total pendaftar: <span class="chip">{{ $registrations->count() }} data</span></p>
            </div>
            <div class="actions">
                <a href="{{ route('teacher.profile.edit') }}" class="back">
                    <span class="material-symbols-rounded" aria-hidden="true">manage_accounts</span>
                    Profil
                </a>
                <form action="{{ route('teacher.logout') }}" method="post">
                    @csrf
                    <button class="back" type="submit">
                        <span class="material-symbols-rounded" aria-hidden="true">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="dashboard-grid">
            <section class="card panel">
                <div class="panel-header">
                    <h2>Buat Kelas Baru</h2>
                </div>

                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                <form class="class-form" action="{{ route('teacher.classes.store') }}" method="post">
                    @csrf
                    <input class="class-input" type="text" name="name" placeholder="Nama kelas, contoh: VII A" required>
                    <button class="class-submit" type="submit">Generate Kode Kelas</button>
                </form>
            </section>

            <section class="card panel">
                <div class="panel-header">
                    <h2>Kelas Saya</h2>
                    <form action="{{ route('teacher.dashboard') }}" method="get" style="display: flex; gap: 6px; align-items: center;">
                        <input class="search-input" type="search" name="q_classes" value="{{ $searchClasses ?? '' }}" placeholder="Cari kelas..." style="padding: 6px 12px; font-size: 0.8rem; max-width: 140px;">
                    </form>
                </div>

                @if (($teacherClasses ?? collect())->isEmpty())
                    <p class="empty">Belum ada kelas yang dibuat.</p>
                @else
                    <div class="class-list">
                        @foreach ($teacherClasses as $teacherClass)
                            <div class="class-item {{ $selectedClassId == $teacherClass->id ? 'is-active' : '' }}">
                                <div class="class-item-top">
                                    <div>
                                        <strong>{{ $teacherClass->name }}</strong><br>
                                        <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                                            <span>Kode: <span class="class-code" id="code-{{ $teacherClass->id }}">{{ $teacherClass->code }}</span></span>
                                            <button class="icon-btn copy" type="button" data-copy-code="{{ $teacherClass->code }}" title="Salin kode kelas" aria-label="Salin kode kelas" style="width: 28px; height: 28px;">
                                                <span class="material-symbols-rounded" style="font-size: 1.1rem;">content_copy</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="class-actions">
                                        <a href="{{ route('teacher.dashboard', ['class_id' => $teacherClass->id, 'q_classes' => $searchClasses, 'q' => $search]) }}" class="icon-btn view {{ $selectedClassId == $teacherClass->id ? 'active' : '' }}" title="Lihat data kelas ini" aria-label="Lihat data kelas ini">
                                            <span class="material-symbols-rounded" aria-hidden="true">visibility</span>
                                        </a>
                                        <form action="{{ route('teacher.classes.destroy', $teacherClass) }}" method="post" onsubmit="return confirm('Hapus kelas ini? Semua data pada kelas ini juga akan terlepas dari kelas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn delete" type="submit" title="Hapus kelas" aria-label="Hapus kelas">
                                                <span class="material-symbols-rounded" aria-hidden="true">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($teacherClasses->hasPages())
                        <div class="pagination-wrap">
                            {{ $teacherClasses->appends(['q' => $search, 'q_classes' => $searchClasses])->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                @endif
            </section>
        </div>

        <section class="card">
            <div class="panel-header" style="padding: 16px 16px 0;">
                <h2 style="font-size: 1.1rem; margin: 0;">
                    Data Pendaftar
                    @if ($selectedClassId)
                        <span style="color: var(--accent); font-weight: 700;">
                            @php
                                $currentClass = collect($teacherClasses->items())->firstWhere('id', $selectedClassId);
                            @endphp
                            ({{ $currentClass ? $currentClass->name : 'Kelas Terpilih' }})
                        </span>
                    @endif
                </h2>
                <div style="display: flex; gap: 10px; align-items: center;">
                    @if ($selectedClassId)
                        <a href="{{ route('teacher.dashboard', ['q' => $search, 'q_classes' => $searchClasses]) }}" class="back" style="font-size: 0.78rem; padding: 6px 12px; height: auto;">
                            <span class="material-symbols-rounded" style="font-size: 1rem;">list</span>
                            Lihat Semua
                        </a>
                    @endif
                    <form class="search-form" action="{{ route('teacher.dashboard') }}" method="get" style="max-width: 320px;">
                        @if ($selectedClassId)
                            <input type="hidden" name="class_id" value="{{ $selectedClassId }}">
                        @endif
                        <input class="search-input" type="search" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama atau sekolah">
                        <button class="search-btn" type="submit">
                            <span class="material-symbols-rounded" aria-hidden="true">search</span>
                        </button>
                    </form>
                    <a href="{{ route('teacher.export.pdf', ['q' => $search, 'class_id' => $selectedClassId]) }}" class="back" style="font-size: 0.78rem; padding: 6px 12px; height: auto; background: var(--success); color: #fff; border-color: var(--success);" title="Download laporan PDF">
                        <span class="material-symbols-rounded" style="font-size: 1rem;">picture_as_pdf</span>
                        Download PDF
                    </a>
                </div>
            </div>
            
            @if (!empty($search))
                <div style="padding: 0 16px 10px;">
                    <a class="search-clear" href="{{ route('teacher.dashboard') }}">Reset pencarian</a>
                </div>
            @endif
            @if ($registrations->isEmpty())
                <p class="empty">Belum ada data user yang tersimpan.</p>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th class="col-kelas">Kelas</th>
                                <th class="col-tgl-lahir">Tanggal Lahir</th>
                                <th class="col-poin">Total Poin</th>
                                <th class="col-waktu-test">Waktu Test</th>
                                <th class="col-waktu-daftar">Waktu Daftar</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $index => $registration)
                                <tr>
                                    <td class="col-no">{{ $index + 1 }}</td>
                                    <td>{{ $registration->name }}</td>
                                    <td>{{ $registration->school }}</td>
                                    <td class="col-kelas">{{ $registration->class_name }}</td>
                                    <td class="col-tgl-lahir">{{ $registration->birth_date->format('d-m-Y') }}</td>
                                    <td class="col-poin">
                                        @if (!is_null($registration->total_poin))
                                            <span class="chip">{{ $registration->total_poin }} poin</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="col-waktu-test">{{ $registration->tested_at ? $registration->tested_at->format('d-m-Y H:i') : '-' }}</td>
                                    <td class="col-waktu-daftar">{{ $registration->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="col-aksi">
                                        <div class="actions-cell">
                                            <a class="action-btn edit" href="{{ route('teacher.registrations.edit', $registration) }}">
                                                <span class="material-symbols-rounded" aria-hidden="true">edit</span>
                                                Edit
                                            </a>
                                            <form action="{{ route('teacher.registrations.destroy', $registration) }}" method="post" onsubmit="return confirm('Hapus data pendaftaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="action-btn delete" type="submit">
                                                    <span class="material-symbols-rounded" aria-hidden="true">delete</span>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>

    <script>
        document.querySelectorAll('[data-copy-code]').forEach((button) => {
            button.addEventListener('click', async () => {
                const code = button.getAttribute('data-copy-code');
                if (!code) return;

                try {
                    await navigator.clipboard.writeText(code);
                    const original = button.innerHTML;
                    button.innerHTML = '<span class="material-symbols-rounded" aria-hidden="true">check</span>';
                    setTimeout(() => {
                        button.innerHTML = original;
                    }, 1200);
                } catch (error) {
                    alert('Gagal menyalin kode kelas.');
                }
            });
        });
    </script>
</body>
</html>
