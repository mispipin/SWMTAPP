<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test - Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1e2644;
            --muted: #5f6678;
            --accent: #1088c8;
            --good: #14a44d;
            --bad: #ef4444;
            --shell-shadow: 0 18px 50px rgba(38, 45, 68, 0.08);
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
                radial-gradient(circle at 14% 12%, rgba(176, 226, 255, 0.75), rgba(176, 226, 255, 0) 30%),
                radial-gradient(circle at 88% 18%, rgba(255, 239, 153, 0.84), rgba(255, 239, 153, 0) 30%),
                linear-gradient(180deg, #f6fbff 0%, #f6f6ed 100%);
            overflow-x: hidden;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 26px 16px;
        }

        .result-shell {
            width: min(860px, 100%);
            border-radius: 28px;
            padding: 18px;
            background: rgba(255, 255, 255, 0.56);
            border: 1px solid rgba(255, 255, 255, 0.52);
            box-shadow: var(--shell-shadow);
            backdrop-filter: blur(8px);
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 26px;
        }

        .metric-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 10px 10px 12px;
            box-shadow: 0 8px 18px rgba(27, 42, 68, 0.08);
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        .metric-card.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .metric-title {
            margin: 0 0 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #1f232f;
            white-space: nowrap;
        }

        .metric-title .material-symbols-rounded {
            font-size: 0.95rem;
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
        }

        .metric-title.good .material-symbols-rounded {
            color: var(--good);
        }

        .metric-title.bad .material-symbols-rounded {
            color: var(--bad);
        }

        .metric-value {
            height: 36px;
            border-radius: 6px;
            background: #f5f7f9;
            display: grid;
            place-items: center;
            font-size: 1rem;
            font-weight: 500;
            color: #1f232f;
            margin-bottom: 10px;
        }

        .metric-number {
            min-width: 20px;
            text-align: center;
            display: inline-block;
        }

        .metric-pill {
            height: 34px;
            width: fit-content;
            padding: 0 12px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            font-size: 0.82rem;
            font-weight: 600;
            margin: 0 auto;
        }

        .metric-pill.good {
            background: #bfe7f8;
            color: #0978b5;
        }

        .metric-pill.bad {
            background: #d9edf8;
            color: #7a93a5;
        }

        .total-card {
            width: min(440px, 100%);
            margin: 0 auto;
            background:
                radial-gradient(circle at 18% 16%, rgba(255, 248, 208, 0.65), rgba(255, 248, 208, 0) 42%),
                linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 16px 34px rgba(27, 42, 68, 0.1);
            padding: 18px 16px 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .celebration-layer {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3) !important;
            opacity: 0.9;
        }

        .spark {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 999px;
            opacity: 0;
            animation: float-spark 1200ms ease forwards;
        }

        @keyframes float-spark {
            0% {
                opacity: 0;
                transform: translateY(8px) scale(0.8);
            }
            15% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: translateY(-34px) scale(1.05);
            }
        }

        .category-wrap {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(30, 38, 68, 0.08);
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 6px 12px;
            background: #e8f1f8;
            color: #0f6b99;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .category-desc {
            margin: 0;
            font-size: 0.76rem;
            line-height: 1.45;
            color: #5f6678;
            white-space: nowrap;
        }

        .score-image {
            width: min(145px, 100%);
            height: auto;
            display: block;
            margin: 0 auto 12px;
            animation: float-star 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 15px rgba(255, 193, 7, 0.2));
        }

        @keyframes float-star {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-10px) scale(1.05);
            }
        }

        .total-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1f232f;
        }

        .score-progress {
            margin: 10px auto 0;
            width: min(300px, 100%);
        }

        .score-progress-label {
            margin: 0 0 6px;
            font-size: 0.72rem;
            color: #607089;
            font-weight: 600;
        }

        .score-track {
            height: 8px;
            background: #dbe4ef;
            border-radius: 999px;
            overflow: hidden;
        }

        .score-fill {
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #4acb73 0%, #2aaa58 100%);
            border-radius: 999px;
            transition: width 1s ease;
        }

        .score-progress-markers {
            margin-top: 6px;
            display: flex;
            justify-content: space-between;
            font-size: 0.68rem;
            color: #7a8698;
        }

        .total-pill {
            padding: 6px 16px;
            border-radius: 999px;
            background: linear-gradient(180deg, #b0edbd 0%, #91ddb2 100%);
            color: #039f25;
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1.2;
            box-shadow: 0 8px 14px rgba(66, 166, 92, 0.2);
        }

        .home-float {
            position: fixed;
            right: 18px;
            bottom: 18px;
            width: 48px;
            height: 48px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            text-decoration: none;
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #ffffff;
            box-shadow: 0 12px 24px rgba(18, 133, 195, 0.3);
            z-index: 50;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.4s ease;
            opacity: 1;
        }

        .home-float.is-hidden, .home-float-wrap.is-hidden {
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
        }

        .home-float:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(18, 133, 195, 0.36);
        }

        .home-float .material-symbols-rounded {
            font-size: 1.2rem;
            font-variation-settings: 'FILL' 1, 'wght' 650, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
        }

        @media (max-width: 860px) {
            .metric-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .result-shell {
                border-radius: 20px;
                padding: 14px;
            }

            .metric-grid {
                gap: 10px;
                margin-bottom: 18px;
            }

            .metric-title {
                font-size: 0.7rem;
            }

            .metric-value {
                height: 32px;
                font-size: 0.92rem;
            }

            .metric-pill {
                height: 30px;
                font-size: 0.74rem;
                padding: 0 10px;
            }

            .score-image {
                width: min(120px, 100%);
            }

            .total-row {
                font-size: 0.84rem;
            }

            .total-pill {
                font-size: 0.95rem;
            }

            .score-progress {
                width: min(240px, 100%);
            }

            .score-progress-label {
                font-size: 0.68rem;
            }

            .category-pill {
                font-size: 0.75rem;
            }

            .category-desc {
                font-size: 0.72rem;
                white-space: normal;
            }

            .home-float {
                right: 12px;
                bottom: 12px;
                width: 42px;
                height: 42px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="result-shell">
            <div class="metric-grid">
                <article class="metric-card">
                    <p class="metric-title good">
                        <span class="material-symbols-rounded">groups</span>
                        Orang Benar
                    </p>
                    <div class="metric-value"><span class="metric-number" data-animate="int" data-target="{{ $orangBenar }}">0</span></div>
                    <div class="metric-pill good">+{{ $orangBenar * 5 }} Poin</div>
                </article>

                <article class="metric-card">
                    <p class="metric-title good">
                        <span class="material-symbols-rounded">verified</span>
                        Urutan Benar
                    </p>
                    <div class="metric-value"><span class="metric-number" data-animate="int" data-target="{{ $urutanBenar }}">0</span></div>
                    <div class="metric-pill good">+{{ $urutanBenar * 5 }} Poin</div>
                </article>

                <article class="metric-card">
                    <p class="metric-title bad">
                        <span class="material-symbols-rounded">person_off</span>
                        Orang Salah
                    </p>
                    <div class="metric-value"><span class="metric-number" data-animate="int" data-target="{{ $orangSalah }}">0</span></div>
                    <div class="metric-pill bad">0 Poin</div>
                </article>

                <article class="metric-card">
                    <p class="metric-title bad">
                        <span class="material-symbols-rounded">cancel</span>
                        Urutan Salah
                    </p>
                    <div class="metric-value"><span class="metric-number" data-animate="int" data-target="{{ $urutanSalah }}">0</span></div>
                    <div class="metric-pill bad">0 Poin</div>
                </article>
            </div>

            <article class="total-card">
                <div class="celebration-layer" id="celebrationLayer"></div>
                <img class="score-image" src="{{ asset('images/Skor.png') }}" alt="Skor">

                <div class="total-row">
                    <span>Total Poin:</span>
                    <span class="total-pill"><span id="totalPoinValue" data-target="{{ $totalPoin }}">0</span> Poin</span>
                </div>

                <div class="score-progress" aria-label="Progress skor total">
                    <p class="score-progress-label">Progress dari maksimum 300 poin</p>
                    <div class="score-track">
                        <div class="score-fill" id="scoreFill"></div>
                    </div>
                    <div class="score-progress-markers">
                        <span>0</span>
                        <span>150</span>
                        <span>300</span>
                    </div>
                </div>

                <div class="category-wrap">
                    <div class="category-pill">Kategori: {{ $kategoriSkor }}</div>
                    <p class="category-desc" style="margin-bottom: 16px;">{{ $deskripsiKategori }}</p>
                    <a href="{{ route('test.result.pdf', $registration) }}" class="btn-download" style="
                        display: inline-flex;
                        align-items: center;
                        gap: 8px;
                        padding: 10px 20px;
                        background: #6366f1;
                        color: #fff;
                        text-decoration: none;
                        border-radius: 12px;
                        font-weight: 600;
                        font-size: 0.85rem;
                        transition: all 0.2s;
                        box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);
                    ">
                        <span class="material-symbols-rounded" style="font-size: 1.1rem;">picture_as_pdf</span>
                        Unduh Hasil (PDF)
                    </a>
                </div>
            </article>
        </section>
    </main>

    <div class="home-float-wrap is-hidden" id="floatWrap" style="
        position: fixed;
        right: 18px;
        bottom: 18px;
        z-index: 50;
        transition: all 0.4s ease;
    ">
        <a
            href="{{ route('register.test') }}"
            style="
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px 24px;
                background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
                color: #ffffff;
                text-decoration: none;
                border-radius: 999px;
                font-weight: 700;
                font-size: 0.9rem;
                box-shadow: 0 10px 25px rgba(18, 133, 195, 0.3);
                transition: all 0.2s;
                white-space: nowrap;
            "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 14px 30px rgba(7, 69, 101, 0.4)'; this.style.filter='brightness(0.9)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(7, 69, 101, 0.3)'; this.style.filter='brightness(1)'"
        >
            <span class="material-symbols-rounded" style="font-size: 1.2rem;">home</span>
            Tes Kembali
        </a>
    </div>

    <script>
        const animateNumber = (element, target, duration = 900) => {
            const start = performance.now();
            const maxValue = Number.isFinite(target) ? target : 0;

            const step = (timestamp) => {
                const progress = Math.min((timestamp - start) / duration, 1);

                const eased = 1 - Math.pow(1 - progress, 3);
                element.textContent = Math.round(maxValue * eased);

                if (progress < 1) {
                    requestAnimationFrame(step);
                }
            };

            requestAnimationFrame(step);
        };

        const showCardReveal = () => {
            const cards = document.querySelectorAll('.metric-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('is-visible');
                }, index * 90);
            });
        };

        const animateScoreProgress = (totalPoin) => {
            const scoreFill = document.getElementById('scoreFill');
            const percent = Math.max(0, Math.min(100, (totalPoin / 300) * 100));

            setTimeout(() => {
                scoreFill.style.width = `${percent}%`;
            }, 220);
        };

        const runCelebration = (totalPoin) => {
            if (totalPoin < 181) {
                return;
            }

            const layer = document.getElementById('celebrationLayer');
            const colors = ['#ffd76d', '#7dd3fc', '#86efac', '#fbcfe8'];

            for (let i = 0; i < 12; i++) {
                const spark = document.createElement('span');
                spark.className = 'spark';
                spark.style.left = `${8 + Math.random() * 84}%`;
                spark.style.top = `${46 + Math.random() * 40}%`;
                spark.style.background = colors[i % colors.length];
                spark.style.animationDelay = `${i * 60}ms`;
                layer.appendChild(spark);

                setTimeout(() => {
                    spark.remove();
                }, 1600);
            }
        };

        window.addEventListener('load', () => {
            showCardReveal();

            document.querySelectorAll('[data-animate="int"]').forEach((el, index) => {
                const target = Number(el.getAttribute('data-target') || '0');
                setTimeout(() => {
                    animateNumber(el, target, 700);
                }, 120 + index * 80);
            });

            const totalPoinEl = document.getElementById('totalPoinValue');
            const totalPoin = Number(totalPoinEl.getAttribute('data-target') || '0');
            animateNumber(totalPoinEl, totalPoin, 1100);
            animateScoreProgress(totalPoin);
            runCelebration(totalPoin);

            // Tampilkan tombol home & tes kembali setelah animasi skor selesai
            setTimeout(() => {
                document.getElementById('floatWrap').classList.remove('is-hidden');
            }, 1300);
        });
    </script>
</body>
</html>
