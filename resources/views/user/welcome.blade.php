<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #18181b;
            --muted: #61616b;
            --blue: #1392d0;
            --card: rgba(255,255,255,.78);
            --pink: #ef7b79;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                #f3f3f3
                url('{{ asset('images/REGISTER.svg') }}')
                no-repeat
                center
                top / cover;
            overflow-x: hidden;
        }
        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 18px 24px;
            position: relative;
        }
        .page::before {
            content: "";
            position: absolute;
            inset: 0;
            background: transparent;
            z-index: -2;
            pointer-events: none;
        }
        .page::after {
            content: "";
            position: absolute;
            inset: 0;
            background: transparent;
            z-index: -1;
            pointer-events: none;
        }
        .hero {
            width: min(1080px, 100%);
            text-align: center;
            position: relative;
            animation: fade-in-up .7s ease both;
        }
        .hero-top {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 5;
        }
        .login-trigger {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border: 0;
            border-radius: 999px;
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #fff;
            font: inherit;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 12px 26px rgba(7, 69, 101, 0.3);
            animation: pulse-attention 2s infinite;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .login-trigger:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 15px 30px rgba(7, 69, 101, 0.4);
            animation-play-state: paused;
        }

        @keyframes pulse-attention {
            0% { box-shadow: 0 0 0 0 rgba(7, 69, 101, 0.4); }
            70% { box-shadow: 0 0 0 12px rgba(7, 69, 101, 0); }
            100% { box-shadow: 0 0 0 0 rgba(7, 69, 101, 0); }
        }
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
        }
        .plus {
            position: absolute;
            width: 18px;
            height: 18px;
            top: 8px;
            color: var(--pink);
        }
        .plus::before, .plus::after {
            content: "";
            position: absolute;
            inset: 7px 0;
            height: 4px;
            background: currentColor;
            border-radius: 999px;
        }
        .plus::after { transform: rotate(90deg); }
        .plus.a { left: 24%; }
        .plus.b { right: 24%; }
        .plus.c { top: 378px; left: 17%; }
        .float-emoji {
            position: absolute;
            font-size: 1.6rem;
            opacity: .92;
            animation: float-y 3.2s ease-in-out infinite;
            user-select: none;
            pointer-events: none;
        }
        .float-emoji.e1 { left: 7%; top: 160px; animation-delay: .2s; }
        .float-emoji.e2 { right: 8%; top: 190px; animation-delay: .9s; }
        .float-emoji.e3 { left: 12%; top: 530px; animation-delay: 1.5s; }
        .logo {
            width: 116px;
            height: 116px;
            margin: 0 auto 12px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: rgba(255,255,255,.84);
            box-shadow: 0 10px 30px rgba(43,58,74,.08);
            padding: 2px;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .logo-fallback {
            display: none;
            width: 100%;
            height: 100%;
        }
        .brand { margin: 0; font-size: 21px; font-weight: 600; }
        h1 {
            margin: 8px 0 14px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(2rem, 5.3vw, 4.35rem);
            line-height: .98;
            letter-spacing: -0.05em;
            white-space: nowrap;
        }
        .subtitle {
            margin: 0 auto;
            max-width: 940px;
            color: var(--muted);
            font-size: clamp(.72rem, 1.2vw, .98rem);
            line-height: 1.6;
            white-space: nowrap;
        }
        .login-modal {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            padding: 18px;
            background: rgba(12, 18, 28, 0.36);
            backdrop-filter: blur(6px);
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
            z-index: 50;
        }
        .login-modal.open {
            opacity: 1;
            pointer-events: auto;
        }
        .login-modal-card {
            width: min(680px, 100%);
            border-radius: 24px;
            background: rgba(255,255,255,.94);
            box-shadow: 0 28px 70px rgba(31,44,55,.18);
            border: 1px solid rgba(255,255,255,.5);
            padding: 18px;
            text-align: left;
        }
        .login-modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }
        .login-modal-head strong {
            font-size: 1.1rem;
        }
        .login-modal-close {
            border: 0;
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background: rgba(15,134,195,.1);
            color: #0f86c3;
            cursor: pointer;
            display: grid;
            place-items: center;
        }
        .login-modal-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
        .login-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border-radius: 18px;
            text-decoration: none;
            color: var(--ink);
            border: 1px solid rgba(19,19,19,.08);
            background: rgba(255,255,255,.92);
            box-shadow: 0 14px 30px rgba(31,44,55,.06);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .login-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 36px rgba(31,44,55,.12);
            border-color: rgba(15,134,195,.24);
        }
        .login-option-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            font-size: 1.2rem;
            line-height: 1;
            background: #bfe8ff;
            color: #0874b1;
        }
        .login-option.teacher .login-option-icon {
            background: #ffe9a8;
            color: #d28b00;
        }
        .login-option strong {
            display: block;
            font-size: 1.02rem;
            margin-bottom: 4px;
        }
        .login-option span {
            color: var(--muted);
            font-size: .9rem;
            line-height: 1.45;
        }
        .features {
            margin: 46px auto 0;
            width: min(840px, 100%);
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 26px;
        }
        .card {
            padding: 24px 20px 20px;
            border-radius: 16px;
            background: var(--card);
            border: 1px solid rgba(19,19,19,.08);
            box-shadow: 0 18px 50px rgba(31,44,55,.08);
            backdrop-filter: blur(10px);
            transition: transform .2s ease, box-shadow .2s ease;
            transform-style: preserve-3d;
            will-change: transform;
        }
        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 22px 46px rgba(31,44,55,.16);
        }
        .badge {
            width: 54px;
            height: 54px;
            margin: 0 auto 14px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.12rem;
            line-height: 1;
            font-family: "Segoe UI Emoji", "Apple Color Emoji", "Noto Color Emoji", sans-serif;
            animation: bob 2.2s ease-in-out infinite;
        }
        .badge .material-symbols-rounded {
            font-size: 1.18rem;
        }
        .card h3 { margin: 6px 0 8px; font-size: 1.06rem; }
        .card p { margin: 0; color: var(--muted); font-size: .95rem; line-height: 1.45; }
        .card:nth-child(1) .badge { background: #aee9ea; color: #0c7c82; }
        .card:nth-child(2) .badge { background: #ffe9a8; color: #d28b00; }
        .card:nth-child(3) .badge { background: #bfe8ff; color: #0874b1; }
        .card:nth-child(1) .badge { padding-left: 1px; }
        .card:nth-child(2) .badge { padding-left: 2px; }
        .notice {
            margin: 54px auto 0;
            width: min(980px, 100%);
            padding: 16px 20px;
            border-radius: 999px;
            background: rgba(255,255,255,.74);
            border: 1px solid rgba(0,0,0,.05);
            box-shadow: 0 10px 28px rgba(31,44,55,.06);
            display: flex;
            gap: 14px;
            align-items: center;
            text-align: left;
        }
        .notice .mini {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            background: rgba(255,166,180,.2);
            color: #ef7b79;
        }
        .notice p { margin: 0; color: #6a6a71; line-height: 1.5; }

        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-soft {
            0%, 100% { box-shadow: 0 14px 32px rgba(18,133,195,.28); }
            50% { box-shadow: 0 18px 38px rgba(18,133,195,.4); }
        }
        @keyframes bob {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        @keyframes float-y {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-9px); }
        }
        @media (max-width: 900px) {
            .features { grid-template-columns: 1fr; width: min(520px, 100%); }
            .notice { border-radius: 24px; align-items: flex-start; }
            .plus.a { left: 16px; }
            .plus.b { right: 16px; }
            .plus.c { left: 10px; top: 390px; }
            .float-emoji { display: none; }
            .hero-top { position: static; display: flex; justify-content: flex-end; margin-bottom: 18px; }
            .login-modal-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .page { padding: 18px 14px; }
            .logo { width: 86px; height: 86px; }
            .brand { font-size: 17px; }
            h1 {
                font-size: clamp(1.55rem, 7vw, 2.2rem);
                white-space: normal;
                line-height: 1.08;
            }
            .subtitle {
                font-size: .8rem;
                white-space: normal;
            }
            .features { margin-top: 30px; gap: 16px; }
            .card { padding: 18px 16px 16px; border-radius: 14px; }
            .notice {
                margin-top: 28px;
                padding: 14px 14px;
                border-radius: 18px;
                align-items: flex-start;
            }
            .notice p { font-size: .85rem; }
        }

        @media (max-width: 420px) {
            .hero { width: 100%; }
            .card h3 { font-size: .98rem; }
            .card p { font-size: .88rem; }
            .role-link strong { font-size: 1rem; }
            .role-link span { font-size: .86rem; }
        }
    </style>
</head>
<body>
    <main class="page">
        <span class="plus a" aria-hidden="true"></span>
        <span class="plus b" aria-hidden="true"></span>
        <span class="plus c" aria-hidden="true"></span>
        <span class="float-emoji e1 material-symbols-rounded" aria-hidden="true">my_location</span>
        <span class="float-emoji e2 material-symbols-rounded" aria-hidden="true">rocket_launch</span>
        <span class="float-emoji e3 material-symbols-rounded" aria-hidden="true">extension</span>

        <section class="hero">
            <div class="hero-top">
                <button class="login-trigger" type="button" data-open-login-modal>
                    Login
                </button>
            </div>

            <div class="logo" aria-hidden="true">
                <img
                    src="{{ asset('images/Logo.png') }}"
                    alt="Logo Spatial Working Memory Test"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                >
                <svg class="logo-fallback" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="39" cy="39" r="34" fill="#A8E0FF"/>
                    <path d="M24 30c0-5.523 4.477-10 10-10h3.5c3.314 0 6 2.686 6 6v2" stroke="#2D5C8A" stroke-width="3.2" stroke-linecap="round"/>
                    <path d="M54 30c0-5.523-4.477-10-10-10h-3.5c-3.314 0-6 2.686-6 6v2" stroke="#2D5C8A" stroke-width="3.2" stroke-linecap="round"/>
                    <path d="M24 48c0 5.523 4.477 10 10 10h3.5c3.314 0 6-2.686 6-6v-2" stroke="#2D5C8A" stroke-width="3.2" stroke-linecap="round"/>
                    <path d="M54 48c0 5.523-4.477 10-10 10h-3.5c-3.314 0-6-2.686-6-6v-2" stroke="#2D5C8A" stroke-width="3.2" stroke-linecap="round"/>
                    <path d="M39 15v48" stroke="#2D5C8A" stroke-width="3.2" stroke-linecap="round"/>
                    <path d="M25 23c3 1.6 5.5 4.5 6 8M53 23c-3 1.6-5.5 4.5-6 8M25 55c3-1.6 5.5-4.5 6-8M53 55c-3-1.6-5.5-4.5-6-8" stroke="#2D5C8A" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M47 33l5 5 12-12" stroke="#ffffff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M47 33l5 5 12-12" stroke="#2D5C8A" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <p class="brand">TUP X UMP</p>
            <h1>Spatial Working Memory Test</h1>
            <p class="subtitle">Tingkatkan dan ukur kemampuan memori kerja spasial Anda melalui pengalaman tes interaktif yang menarik</p>

            <div id="features" class="features">
                <article class="card">
                    <div class="badge"><span class="material-symbols-rounded" aria-hidden="true">flash_on</span></div>
                    <h3>Cepat &amp; Interaktif</h3>
                    <p>Tes dirancang untuk menguji refleks dan memori Anda secara real-time</p>
                </article>
                <article class="card">
                    <div class="badge"><span class="material-symbols-rounded" aria-hidden="true">folder_open</span></div>
                    <h3>Mudah Digunakan</h3>
                    <p>Antarmuka yang sederhana dan ramah pengguna</p>
                </article>
                <article class="card">
                    <div class="badge"><span class="material-symbols-rounded" aria-hidden="true">workspace_premium</span></div>
                    <h3>Hasil Terukur</h3>
                    <p>Hasil Anda akan tersimpan dengan baik di sistem kami</p>
                </article>
            </div>

            <div class="notice">
                <div class="mini" aria-hidden="true">🧠</div>
                <p>Tes ini dirancang khusus untuk siswa sekolah menengah pertama hingga sekolah menengah atas guna mengukur dan melatih kemampuan memori kerja spasial.</p>
            </div>
        </section>
    </main>

    <div class="login-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Pilihan login" data-login-modal>
        <div class="login-modal-card">
            <div class="login-modal-head">
                <strong>Login sebagai</strong>
                <button class="login-modal-close" type="button" data-close-login-modal aria-label="Tutup popup">
                    <span class="material-symbols-rounded" aria-hidden="true">close</span>
                </button>
            </div>

            <div class="login-modal-grid">
                <a class="login-option student" href="{{ route('student.login') }}">
                    <div class="login-option-icon material-symbols-rounded" aria-hidden="true">school</div>
                    <div>
                        <strong>Siswa</strong>
                        <span>Login atau daftar terlebih dahulu sebelum mengisi data tes.</span>
                    </div>
                </a>

                <a class="login-option teacher" href="{{ route('teacher.login') }}">
                    <div class="login-option-icon material-symbols-rounded" aria-hidden="true">admin_panel_settings</div>
                    <div>
                        <strong>Guru</strong>
                        <span>Masuk ke dashboard untuk mengelola kelas dan data peserta.</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        const cards = document.querySelectorAll('.card');
        cards.forEach((card) => {
            card.addEventListener('mousemove', (event) => {
                const rect = card.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;
                const rotateY = ((x / rect.width) - 0.5) * 8;
                const rotateX = ((y / rect.height) - 0.5) * -8;
                card.style.transform = `translateY(-8px) scale(1.02) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });

        const loginModal = document.querySelector('[data-login-modal]');
        const openLoginModal = document.querySelector('[data-open-login-modal]');
        const closeLoginModal = document.querySelector('[data-close-login-modal]');

        const showLoginModal = () => {
            loginModal.classList.add('open');
            loginModal.setAttribute('aria-hidden', 'false');
        };

        const hideLoginModal = () => {
            loginModal.classList.remove('open');
            loginModal.setAttribute('aria-hidden', 'true');
        };

        openLoginModal?.addEventListener('click', showLoginModal);
        closeLoginModal?.addEventListener('click', hideLoginModal);
        loginModal?.addEventListener('click', (event) => {
            if (event.target === loginModal) {
                hideLoginModal();
            }
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                hideLoginModal();
            }
        });

    </script>
</body>
</html>
