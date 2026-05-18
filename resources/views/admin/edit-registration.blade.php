<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftaran - SWMT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1d2440;
            --muted: #5f6674;
            --line: rgba(17, 24, 39, 0.12);
            --card: rgba(255, 255, 255, 0.82);
            --button: #0f86c3;
            --button-hover: #0d78ad;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: Poppins, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 30% 20%, rgba(155, 216, 243, 0.55), rgba(155, 216, 243, 0) 44%),
                radial-gradient(circle at 78% 42%, rgba(247, 232, 133, 0.6), rgba(247, 232, 133, 0) 42%),
                #f2f3ee
                url('{{ asset('images/REGISTER.svg') }}')
                no-repeat
                center
                top / cover;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 16px;
        }

        .card {
            width: min(500px, 100%);
            padding: 22px 26px 20px;
            border-radius: 14px;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 26px 72px rgba(24, 35, 51, 0.14);
            backdrop-filter: blur(9px);
        }

        h1 {
            margin: 0;
            text-align: center;
            font-size: clamp(1.85rem, 3.8vw, 2.2rem);
            line-height: 1;
            font-weight: 700;
        }

        .subtitle {
            margin: 10px 0 22px;
            text-align: center;
            font-size: 1.02rem;
            color: #222a3d;
        }

        .field {
            margin-bottom: 12px;
        }

        .label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: #2a3143;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
            font-size: 1.05rem;
            line-height: 1;
        }

        input,
        textarea {
            width: 100%;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.64);
            outline: none;
            font: inherit;
            color: #1f2739;
            padding: 10px 12px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        textarea {
            min-height: 62px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: rgba(15, 134, 195, 0.48);
            box-shadow: 0 0 0 3px rgba(15, 134, 195, 0.14);
        }

        .btn {
            margin-top: 8px;
            width: 100%;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(180deg, #1493d2 0%, var(--button) 100%);
            color: #fff;
            font: inherit;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 12px 16px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .btn:hover {
            background: linear-gradient(180deg, #118aca 0%, var(--button-hover) 100%);
            transform: translateY(-1px);
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }

        .btn.secondary {
            background: linear-gradient(180deg, #ef7b79 0%, #d84f4d 100%);
            color: #fff;
            border: 0;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn.secondary:hover {
            background: linear-gradient(180deg, #f08a88 0%, #cc4341 100%);
            transform: translateY(-1px);
        }

        .alert {
            margin: 0 0 14px;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
            line-height: 1.4;
            color: #8e2432;
            background: rgba(220, 64, 64, 0.12);
            border: 1px solid rgba(220, 64, 64, 0.28);
        }

        @media (max-width: 560px) {
            .card {
                padding: 18px 16px 16px;
                border-radius: 12px;
            }

            .subtitle {
                font-size: 0.95rem;
            }

            h1 {
                font-size: clamp(1.45rem, 8vw, 1.9rem);
                white-space: normal;
            }

            .label {
                font-size: 0.88rem;
            }

            input,
            textarea {
                padding: 10px 11px;
                border-radius: 12px;
            }

            .btn {
                font-size: 0.98rem;
                padding: 11px 14px;
            }

            .actions {
                flex-direction: column;
            }

            .actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .page { padding: 18px 12px; }
            .card { width: 100%; }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="card" aria-label="Edit Data Pendaftaran">
            <h1>Edit Pendaftaran</h1>
            <p class="subtitle">Spatial Working Memory Test</p>

            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('teacher.registrations.update', $registration) }}" method="post">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="label" for="school">
                        <span class="material-symbols-rounded" aria-hidden="true">school</span>
                        Asal Sekolah
                    </label>
                    <input id="school" name="school" type="text" value="{{ old('school', $registration->school) }}" required>
                </div>

                <div class="field">
                    <label class="label" for="class_name">
                        <span class="material-symbols-rounded" aria-hidden="true">group</span>
                        Kelas
                    </label>
                    <input id="class_name" name="class_name" type="text" value="{{ old('class_name', $registration->class_name) }}" required>
                </div>

                <div class="field">
                    <label class="label" for="name">
                        <span class="material-symbols-rounded" aria-hidden="true">person</span>
                        Nama
                    </label>
                    <input id="name" name="name" type="text" value="{{ old('name', $registration->name) }}" required>
                </div>

                <div class="field">
                    <label class="label" for="birth_date">
                        <span class="material-symbols-rounded" aria-hidden="true">calendar_month</span>
                        Tanggal Lahir
                    </label>
                    <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', optional($registration->birth_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="actions">
                    <a class="btn secondary" href="{{ route('teacher.dashboard') }}">Batal</a>
                    <button class="btn" type="submit">Simpan</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
