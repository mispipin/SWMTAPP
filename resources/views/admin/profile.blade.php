<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - SWMT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,500,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1a2138;
            --muted: #5f6877;
            --line: rgba(17, 24, 39, 0.1);
            --card: rgba(255, 255, 255, 0.88);
            --accent: {{ $user->role === 'superadmin' ? '#6366f1' : '#0f86c3' }};
            --success: #22c55e;
            --error: #ef4444;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Poppins, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 14%, rgba(15, 134, 195, 0.1), rgba(15, 134, 195, 0) 34%),
                radial-gradient(circle at 86% 18%, rgba(248, 235, 153, 0.1), rgba(248, 235, 153, 0) 32%),
                #f2f3ee;
            padding: 26px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrap {
            width: min(500px, 100%);
        }

        .card {
            background: var(--card);
            padding: 34px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
        }

        .header {
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--ink);
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.5);
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 134, 195, 0.1);
        }

        .btn-group {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border-radius: 14px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--ink);
        }

        .alert {
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .alert-success { background: rgba(34, 197, 94, 0.1); color: var(--success); }
        .alert-error { background: rgba(239, 68, 68, 0.1); color: var(--error); }

        .divider {
            height: 1px;
            background: var(--line);
            margin: 30px 0;
            position: relative;
        }

        .divider::after {
            content: "Keamanan Akun";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--card);
            padding: 0 10px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div class="header">
                <span style="font-size: 32px; color: var(--accent);" class="material-symbols-rounded">manage_accounts</span>
                <h1>Pengaturan Profil</h1>
                <p>Kelola informasi akun dan kata sandi Anda</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('teacher.profile.update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="divider"></div>

                <div class="form-group">
                    <label>Password Saat Ini (isi jika ingin ganti password)</label>
                    <input type="password" name="current_password">
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="new_password">
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn">Simpan Perubahan</button>
                    <a href="{{ $user->role === 'superadmin' ? route('superadmin.dashboard') : route('teacher.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
