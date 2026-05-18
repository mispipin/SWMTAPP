<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - Spatial Working Memory Test</title>
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
            width: min(520px, 100%);
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
            margin: 10px 0 14px;
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

        input {
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

        input::placeholder {
            color: #8f96a4;
            font-size: 0.92rem;
        }

        input:focus {
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn.secondary {
            background: rgba(255, 255, 255, 0.74);
            color: #1d2440;
            border: 1px solid var(--line);
        }

        .btn:hover {
            background: linear-gradient(180deg, #118aca 0%, var(--button-hover) 100%);
            transform: translateY(-1px);
        }

        .btn.secondary:hover {
            background: rgba(255, 255, 255, 0.74);
            color: #1d2440;
            transform: none;
        }

        .register-highlight {
            color: #0f86c3;
            margin-left: 4px;
        }

        .google-btn {
            margin-top: 12px;
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.74);
            color: #33435f;
            font: inherit;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 12px 16px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .google-btn:hover {
            background: rgba(255, 255, 255, 0.88);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 18px 0 14px;
            color: #7a8799;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(17, 24, 39, 0.12);
        }

        .section-title {
            margin: 0 0 14px;
            color: #5b6475;
            font-size: 1rem;
            font-weight: 500;
        }

        .alert {
            margin: 0 0 14px;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .alert.success {
            background: rgba(25, 170, 88, 0.14);
            color: #0f6a37;
            border: 1px solid rgba(25, 170, 88, 0.28);
        }

        .alert.error {
            background: rgba(220, 64, 64, 0.12);
            color: #8e2432;
            border: 1px solid rgba(220, 64, 64, 0.28);
        }

        .google-btn img {
            width: 20px;
            height: 20px;
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

            input {
                padding: 10px 11px;
                border-radius: 12px;
            }

            .btn {
                font-size: 0.98rem;
                padding: 11px 14px;
            }

            .divider {
                gap: 10px;
                margin: 16px 0 12px;
                font-size: 0.9rem;
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
        <section class="card" aria-label="Form Login Guru">
            <h1>Login Guru</h1>
            <p class="subtitle">Spatial Working Memory Test</p>

            <a class="google-btn" href="{{ route('auth.google') }}" aria-label="Login dengan Google">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M18.14 10.23c0-.64-.06-1.26-.17-1.85H10v3.49h4.62c-.2 1.08-.82 2-1.75 2.62v2.18h2.83c1.66-1.53 2.62-3.79 2.62-6.44z" fill="#4285F4"/>
                    <path d="M10 18.5c2.37 0 4.36-.79 5.81-2.13l-2.83-2.18c-.79.53-1.79.85-2.98.85-2.28 0-4.21-1.54-4.91-3.61H2.19v2.24A8.5 8.5 0 0 0 10 18.5z" fill="#34A853"/>
                    <path d="M5.09 11.43A5.1 5.1 0 0 1 4.82 10c0-.5.09-.98.27-1.43V6.33H2.19A8.5 8.5 0 0 0 1.5 10c0 1.37.33 2.66.69 3.67l2.9-2.24z" fill="#FBBC05"/>
                    <path d="M10 4.5c1.29 0 2.45.44 3.36 1.31l2.52-2.52A8.49 8.49 0 0 0 10 1.5 8.5 8.5 0 0 0 2.19 6.33l2.9 2.24C5.79 6.04 7.72 4.5 10 4.5z" fill="#EA4335"/>
                </svg>
                Login dengan Google
            </a>

            <div class="divider">atau</div>

            <p class="section-title">Login dengan Email</p>

            @if (session('success'))
                <p class="alert success">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <p class="alert error">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('teacher.login.process') }}" method="post">
                @csrf

                <div class="field">
                    <label class="label" for="email">
                        <span class="material-symbols-rounded" aria-hidden="true">mail</span>
                        Email
                    </label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan email guru" required>
                </div>

                <div class="field">
                    <label class="label" for="password">
                        <span class="material-symbols-rounded" aria-hidden="true">lock</span>
                        Password
                    </label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" required>
                </div>

                <button class="btn" type="submit">Masuk</button>
            </form>

            <div class="actions">
                <a class="btn secondary" href="{{ route('teacher.register') }}">Daftar sebagai guru? <span class="register-highlight">Register</span></a>
            </div>
        </section>
    </main>
</body>
</html>
