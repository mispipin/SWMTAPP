<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1d2440;
            --muted: #5f6674;
            --line: rgba(17, 24, 39, 0.12);
            --card: rgba(255, 255, 255, 0.82);
            --button: #074565;
            --button-hover: #05364f;
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
            position: relative;
        }

        .card {
            width: min(500px, 100%);
            padding: 22px 26px 20px;
            border-radius: 14px;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 26px 72px rgba(24, 35, 51, 0.14);
            backdrop-filter: blur(9px);
            display: none; /* Hidden by default */
        }

        .card.active {
            display: block;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(29, 36, 64, 0.3);
            backdrop-filter: blur(6px);
            display: grid;
            place-items: center;
            z-index: 1000;
            padding: 20px;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            width: min(400px, 100%);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            text-align: center;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            background: rgba(15, 134, 195, 0.1);
            color: var(--button);
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: 0 auto 20px;
        }

        .modal-icon .material-symbols-rounded {
            font-size: 2rem;
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

        input::placeholder,
        textarea::placeholder {
            color: #8f96a4;
            font-size: 0.92rem;
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
            background: linear-gradient(180deg, #0a5a84 0%, var(--button) 100%);
            color: #fff;
            font: inherit;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 12px 16px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .btn:hover {
            background: linear-gradient(180deg, #074565 0%, #032638 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 69, 101, 0.25);
        }

        .btn:active {
            transform: translateY(0) scale(0.98);
            box-shadow: 0 4px 10px rgba(7, 69, 101, 0.2);
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

        @media (max-width: 560px) {
            .card {
                padding: 18px 16px 16px;
                border-radius: 12px;
            }

            .subtitle {
                font-size: 0.95rem;
            }

            h1 {
                font-size: clamp(1.5rem, 8vw, 1.95rem);
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
        }

        @media (max-width: 420px) {
            .page { padding: 18px 12px; }
            .card { width: 100%; }
        }
    </style>
</head>
<body>
    <main class="page">
        <!-- Modal Popup Kode Kelas -->
        <div id="codeModal" class="modal-overlay {{ old('class_code') || $errors->has('class_code') ? 'hidden' : '' }}">
            <div class="modal-content">
                <div class="modal-icon">
                    <span class="material-symbols-rounded">key</span>
                </div>
                <h2 style="margin: 0 0 8px; font-weight: 700;">Masukan Kode Kelas</h2>
                <p style="color: var(--muted); font-size: 0.9rem; margin-bottom: 24px;">Silakan masukkan kode kelas yang diberikan oleh guru Anda.</p>
                
                <div class="field" style="text-align: left;">
                    <label class="label" for="modal_class_code">Kode Kelas</label>
                    <input id="modal_class_code" type="text" placeholder="Contoh: AB123" autocomplete="off">
                    <p id="modalError" style="color: #dc4040; font-size: 0.8rem; margin: 4px 0 0; display: none;">Kode kelas wajib diisi.</p>
                </div>

                <button type="button" class="btn" style="transition: all 0.2s;" onmousedown="this.style.transform='scale(0.96)'" onmouseup="this.style.transform='scale(1)'" onclick="submitClassCode()">Lanjut</button>
                
                <button type="button" class="btn" style="
                    margin-top: 12px;
                    background: transparent;
                    color: var(--ink);
                    border: none;
                    box-shadow: none;
                    font-size: 0.9rem;
                    font-weight: 500;
                    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                " 
                onmouseover="this.style.color='var(--button)'; this.style.transform='translateY(-1px)'"
                onmouseout="this.style.color='var(--ink)'; this.style.transform='translateY(0)'"
                onmousedown="this.style.transform='scale(0.96)'"
                onmouseup="this.style.transform='scale(1)'"
                onclick="skipClassCode()">Saya tidak memiliki kode</button>
            </div>
        </div>

        <section id="registerCard" class="card {{ old('class_code') || $errors->has('class_code') ? 'active' : '' }}" aria-label="Form Pendaftaran Spatial Working Memory Test">
            <h1>Pendaftaran</h1>
            <p class="subtitle">Spatial Working Memory Test</p>

            @if (session('success'))
                <p class="alert success">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register.test.store') }}" method="post">
                @csrf

                <!-- Hidden Input untuk Kode Kelas -->
                <input type="hidden" id="class_code" name="class_code" value="{{ old('class_code') }}">

                <div class="field">
                    <label class="label" for="school">
                        <span class="material-symbols-rounded" aria-hidden="true">school</span>
                        Asal Sekolah
                    </label>
                    <input id="school" name="school" type="text" value="{{ old('school') }}" placeholder="Masukkan nama sekolah" required>
                </div>

                <div class="field">
                    <label class="label" for="class_name">
                        <span class="material-symbols-rounded" aria-hidden="true">group</span>
                        Kelas
                    </label>
                    <input id="class_name" name="class_name" type="text" value="{{ old('class_name') }}" placeholder="Masukkan kelas" required>
                </div>

                <div class="field">
                    <label class="label" for="name">
                        <span class="material-symbols-rounded" aria-hidden="true">person</span>
                        Nama Lengkap
                    </label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Masukkan nama lengkap kamu" required>
                </div>

                <div class="field">
                    <label class="label" for="birth_date">
                        <span class="material-symbols-rounded" aria-hidden="true">calendar_month</span>
                        Tanggal Lahir
                    </label>
                    <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}" required>
                </div>

                <button class="btn" type="submit">Ikuti test memori</button>
            </form>
        </section>
    </main>

    <script>
        function skipClassCode() {
            const hiddenInput = document.getElementById('class_code');
            const modal = document.getElementById('codeModal');
            const card = document.getElementById('registerCard');

            // Kosongkan kode kelas (akan masuk ke super admin)
            hiddenInput.value = '';
            
            modal.classList.add('hidden');
            card.classList.add('active');
        }

        function submitClassCode() {
            const modalInput = document.getElementById('modal_class_code');
            const hiddenInput = document.getElementById('class_code');
            const modalError = document.getElementById('modalError');
            const modal = document.getElementById('codeModal');
            const card = document.getElementById('registerCard');

            if (!modalInput.value.trim()) {
                modalError.style.display = 'block';
                return;
            }

            // Set nilai ke input hidden di form utama
            hiddenInput.value = modalInput.value;
            
            // Sembunyikan modal dan tampilkan form pendaftaran
            modal.classList.add('hidden');
            card.classList.add('active');
        }

        // Jika menekan Enter di input modal
        document.getElementById('modal_class_code').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                submitClassCode();
            }
        });
    </script>
</body>
</html>
