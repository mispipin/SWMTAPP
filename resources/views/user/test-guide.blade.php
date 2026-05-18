<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Test - Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1e2644;
            --muted: #5d6476;
            --card: rgba(255, 255, 255, 0.95);
            --accent: #1088c8;
            --warn: #e25f5f;
            --shadow: 0 18px 50px rgba(38, 45, 68, 0.08);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: Poppins, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            color: var(--ink);
            background:
                radial-gradient(circle at 14% 12%, rgba(176, 226, 255, 0.75), rgba(176, 226, 255, 0) 30%),
                radial-gradient(circle at 88% 18%, rgba(255, 239, 153, 0.84), rgba(255, 239, 153, 0) 30%),
                linear-gradient(180deg, #f6fbff 0%, #f6f6ed 100%);
            overflow-x: hidden;
        }

        .page {
            min-height: 100vh;
            padding: 12px 14px 22px;
        }

        .topbar {
            width: min(1180px, 100%);
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #2d6798;
            font-size: 1.2rem;
            font-weight: 900;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .brand img {
            width: 28px;
            height: 28px;
            object-fit: cover;
            border-radius: 50%;
        }

        .top-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 11px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(17, 24, 39, 0.06);
            box-shadow: 0 8px 24px rgba(31, 41, 55, 0.06);
            color: #6e2a94;
            text-decoration: none;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
        }

        .top-form {
            margin: 0;
        }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }

        .shell {
            width: min(1080px, 100%);
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
            padding: 20px 20px 16px;
        }

        .hero {
            text-align: center;
            padding: 4px 8px 2px;
        }

        .hero-logo {
            width: 86px;
            height: 86px;
            margin: 0 auto 12px;
        }

        .hero-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.85rem, 3.5vw, 2.9rem);
            line-height: 1.02;
            letter-spacing: -0.04em;
            font-weight: 800;
        }

        .subtitle {
            margin: 6px auto 0;
            max-width: 700px;
            color: #596174;
            font-size: clamp(.84rem, .95vw, .93rem);
            line-height: 1.5;
        }

        .section-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 22px 0 12px;
            font-size: 1rem;
            font-weight: 700;
            color: #273456;
        }

        .section-title .material-symbols-rounded {
            width: 28px;
            height: 28px;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(17, 135, 201, 0.12);
            color: var(--accent);
            font-size: 1rem;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .step {
            position: relative;
            min-height: 258px;
            padding: 50px 18px 22px;
            border-radius: 30px;
            background: var(--card);
            box-shadow: 0 14px 34px rgba(43, 51, 72, 0.08);
            text-align: center;
        }

        .step-number {
            position: absolute;
            top: -12px;
            left: 14px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #fff;
            color: #1d2330;
            font-size: 1rem;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(31, 41, 55, 0.08);
        }

        .step-illustration {
            height: 106px;
            margin: 2px auto 6px;
            display: grid;
            place-items: center;
            color: #1d97c8;
        }

        .step-illustration img {
            display: block;
            width: auto;
            height: 100%;
            max-width: 150px;
            object-fit: contain;
        }

        .step-illustration .step-one-image {
            max-width: 150px;
            width: auto;
            height: auto;
        }

        .step-illustration .step-two-image {
            width: auto;
            height: auto;
            max-width: 110px;
            max-height: 82px;
        }

        .step-illustration .step-three-image {
            width: auto;
            height: auto;
            max-width: 110px;
            max-height: 82px;
        }

        .step-illustration .material-symbols-rounded {
            font-size: 5.4rem;
        }

        .step:nth-child(2) .step-illustration {
            color: #f3aa5d;
            height: 96px;
            margin: 2px auto 8px;
        }

        .step:nth-child(3) .step-illustration {
            color: #1d97c8;
        }

        .step h3 {
            margin: 0;
            color: #273458;
            font-size: 1.22rem;
            line-height: 1.05;
            font-weight: 800;
        }

        .step h4 {
            margin: 6px 0 8px;
            color: #2c3458;
            font-size: .92rem;
            line-height: 1.2;
            font-weight: 600;
        }

        .step p {
            margin: 0 auto;
            max-width: 250px;
            color: var(--muted);
            font-size: .78rem;
            line-height: 1.5;
        }

        .checklist-card {
            margin-top: 22px;
            border-radius: 18px;
            padding: 14px 14px 16px;
            background: rgba(255, 241, 241, 0.7);
            border: 1px solid rgba(231, 83, 83, 0.45);
            text-align: left;
        }

        .alert-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 10px;
            color: #273456;
            font-size: .98rem;
            font-weight: 700;
            justify-content: flex-start;
            width: 100%;
        }

        .alert-title .material-symbols-rounded {
            width: 28px;
            height: 28px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: rgba(231, 83, 83, 0.15);
            color: #e04848;
            font-size: 1rem;
        }

        .checklist-card ul {
            margin: 0;
            padding-left: 20px;
            color: #3f4861;
            font-size: .8rem;
            line-height: 1.55;
        }

        .readiness-card {
            margin-top: 14px;
            border-radius: 18px;
            padding: 14px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(17, 24, 39, 0.06);
            box-shadow: 0 10px 26px rgba(31, 41, 55, 0.06);
            text-align: left;
        }

        .readiness-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            text-align: left;
        }

        .readiness-head h3 {
            margin: 0;
            font-size: .98rem;
            line-height: 1.2;
        }

        .progress-label {
            font-size: .8rem;
            color: #5f6776;
            white-space: nowrap;
        }

        .progress-bar {
            height: 12px;
            border-radius: 999px;
            background: rgba(17, 24, 39, 0.08);
            overflow: hidden;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #1693d1 0%, #1183bf 100%);
            transition: width .2s ease;
        }

        .readiness-items {
            display: grid;
            gap: 12px;
            margin-top: 10px;
        }

        .readiness-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 12px;
            border-radius: 16px;
            background: rgba(247, 248, 253, 0.95);
            border: 1px solid rgba(17, 24, 39, 0.06);
        }

        .readiness-item input {
            width: 22px;
            height: 22px;
            margin-top: 2px;
            accent-color: #1693d1;
            flex: 0 0 auto;
        }

        .readiness-copy {
            display: grid;
            gap: 2px;
        }

        .readiness-copy strong {
            font-size: .92rem;
            line-height: 1.2;
        }

        .readiness-copy span {
            color: #6a7184;
            font-size: .78rem;
            line-height: 1.35;
        }

        .start-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            margin-top: 16px;
            padding: 11px 16px;
            border-radius: 8px;
            background: linear-gradient(180deg, #1693d1 0%, #1183bf 100%);
            color: #fff;
            text-decoration: none;
            font-size: .88rem;
            font-weight: 700;
            box-shadow: 0 14px 26px rgba(17, 131, 191, 0.22);
            transition: transform .15s ease, opacity .15s ease, filter .15s ease, box-shadow .15s ease;
        }

        .start-btn:hover {
            transform: translateY(-1px);
        }

        .start-btn.disabled {
            opacity: .55;
            filter: grayscale(.2);
            box-shadow: none;
            cursor: not-allowed;
            pointer-events: auto;
        }

        .start-btn.disabled:hover {
            transform: none;
        }

        @media (max-width: 980px) {
            .steps {
                grid-template-columns: 1fr;
            }

            .step {
                min-height: 0;
            }

            h1 {
                font-size: clamp(1.7rem, 5vw, 2.5rem);
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 10px 10px 18px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .shell {
                padding: 18px 14px 16px;
                border-radius: 22px;
            }

            .hero-logo {
                width: 60px;
                height: 60px;
            }

            .section-title {
                font-size: 1rem;
            }

            .step {
                padding: 48px 16px 20px;
                border-radius: 28px;
            }

            .step-illustration {
                height: 100px;
            }

            .step-illustration .material-symbols-rounded {
                font-size: 5rem;
            }

            .step-illustration img {
                max-width: 130px;
            }

            .step-illustration .step-two-image {
                max-width: 92px;
                max-height: 68px;
            }

            .step-illustration .step-three-image {
                max-width: 92px;
                max-height: 68px;
            }

            .step h3 {
                font-size: 1.14rem;
            }

            .step h4 {
                font-size: .9rem;
            }

            .step p {
                font-size: .75rem;
            }

            .checklist-card,
            .readiness-card {
                padding: 12px;
                border-radius: 16px;
            }

            .alert-title,
            .readiness-head h3 {
                font-size: .92rem;
            }

            .checklist-card ul,
            .readiness-copy span,
            .progress-label {
                font-size: .76rem;
            }

            .readiness-item {
                padding: 12px 10px;
            }

            .start-btn {
                font-size: .86rem;
                padding: 10px 14px;
            }
        }

        @media (max-width: 420px) {
            .shell { padding: 14px 12px 14px; }
            .hero-logo { width: 68px; height: 68px; }
            .brand {
                font-size: 1.02rem;
                gap: 8px;
            }
            .brand img {
                width: 24px;
                height: 24px;
            }
            .section-title { font-size: .94rem; }
            .step-number { width: 40px; height: 40px; font-size: .92rem; }
            .step h3 { font-size: 1.05rem; }
            .step h4 { font-size: .86rem; }
            .step p { font-size: .72rem; }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="topbar">
            <a href="{{ url('/') }}" class="brand">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo SWMT">
                <span>SWMT</span>
            </a>

            <form class="top-form" action="{{ route('user.logout') }}" method="post">
                @csrf
                <button type="submit" class="top-btn">
                    <span class="material-symbols-rounded" aria-hidden="true">logout</span>
                    Logout
                </button>
            </form>
        </div>

        <section class="shell">
            <div class="hero">
                <p style="margin:0 0 6px;color:#52617a;font-size:.9rem;">Selamat datang, {{ $registration->name }}.</p>

                <div class="hero-logo">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo SWMT">
                </div>
                <h1>Spatial Working Memory Test</h1>
                <p class="subtitle">Ikuti langkah singkat ini lalu mulai tes</p>

                <h2 class="section-title">
                    <span class="material-symbols-rounded" aria-hidden="true">book_2</span>
                    Cara Bermain:
                </h2>

                <div class="steps" aria-label="Panduan langkah">
                    <article class="step">
                        <span class="step-number">1</span>
                        <div class="step-illustration" aria-hidden="true">
                            <img class="step-one-image" src="{{ asset('images/Tahap1.png') }}" alt="Tahap 1">
                        </div>
                        <h3>Tahap Pertama</h3>
                        <h4>Perhatikan Gambar Wajah</h4>
                        <p>Anda akan diperlihatkan serangkaian gambar wajah dengan ekspresi netral</p>
                    </article>

                    <article class="step">
                        <span class="step-number">2</span>
                        <div class="step-illustration" aria-hidden="true">
                            <img class="step-two-image" src="{{ asset('images/Tahap2.png') }}" alt="Tahap 2">
                        </div>
                        <h3>Tahap Kedua</h3>
                        <h4>Identifikasi Nama Buah</h4>
                        <p>Identifikasi dan sebutkan nama buah yang ditampilkan pada layar</p>
                    </article>

                    <article class="step">
                        <span class="step-number">3</span>
                        <div class="step-illustration" aria-hidden="true">
                            <img class="step-three-image" src="{{ asset('images/Tahap3.png') }}" alt="Tahap 3">
                        </div>
                        <h3>Tahap Ketiga</h3>
                        <h4>Klik Sesuai Urutan</h4>
                        <p>Klik gambar yang sesuai dengan urutan yang telah Anda lihat pada tahap pertama.</p>
                    </article>
                </div>

                <section class="checklist-card" aria-label="Informasi penting">
                    <h3 class="alert-title">
                        <span class="material-symbols-rounded" aria-hidden="true">priority_high</span>
                        Penting Untuk Diketahui:
                    </h3>
                    <ul>
                        <li>Perhatikan urutan kemunculan gambar wajah dengan seksama</li>
                        <li>Ingat nama buah yang ditampilkan sebagai penanda</li>
                        <li>Klik gambar sesuai urutan yang sama persis seperti yang ditampilkan</li>
                        <li>Konsentrasi penuh adalah kunci untuk mendapatkan skor terbaik</li>
                    </ul>
                </section>

                <section class="readiness-card" aria-label="Checklist kesiapan">
                    <div class="readiness-head">
                        <h3>Checklist kesiapan</h3>
                        <span class="progress-label" id="progress-label">0 dari 3 siap</span>
                    </div>
                    <div class="progress-bar" aria-hidden="true">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>

                    <div class="readiness-items">
                        <label class="readiness-item">
                            <input type="checkbox" class="readiness-check">
                            <span class="readiness-copy">
                                <strong>Fokus penuh</strong>
                                <span>Hindari gangguan</span>
                            </span>
                        </label>

                        <label class="readiness-item">
                            <input type="checkbox" class="readiness-check">
                            <span class="readiness-copy">
                                <strong>Perangkat nyaman</strong>
                                <span>Pakai yang paling stabil</span>
                            </span>
                        </label>

                        <label class="readiness-item">
                            <input type="checkbox" class="readiness-check">
                            <span class="readiness-copy">
                                <strong>Siap mengingat urutan</strong>
                                <span>Urutan jadi kunci</span>
                            </span>
                        </label>
                    </div>
                </section>

                <a href="{{ route('test.start', $registration) }}" class="start-btn disabled" id="start-btn" aria-disabled="true">Mulai Test</a>
            </div>
        </section>
    </main>

    <script>
        const readinessChecks = document.querySelectorAll('.readiness-check');
        const progressFill = document.getElementById('progress-fill');
        const progressLabel = document.getElementById('progress-label');
        const startBtn = document.getElementById('start-btn');

        const updateProgress = () => {
            const checkedCount = Array.from(readinessChecks).filter((check) => check.checked).length;
            progressFill.style.width = `${(checkedCount / readinessChecks.length) * 100}%`;
            progressLabel.textContent = `${checkedCount} dari ${readinessChecks.length} siap`;

            const allReady = checkedCount === readinessChecks.length;
            startBtn.classList.toggle('disabled', !allReady);
            startBtn.setAttribute('aria-disabled', allReady ? 'false' : 'true');
        };

        startBtn.addEventListener('click', (event) => {
            const allReady = Array.from(readinessChecks).every((check) => check.checked);
            if (!allReady) {
                event.preventDefault();
            }
        });

        readinessChecks.forEach((check) => check.addEventListener('change', updateProgress));
        updateProgress();
    </script>
</body>
</html>
