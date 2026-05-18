<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1e2644;
            --muted: #5d6476;
            --card: rgba(255, 255, 255, 0.95);
            --accent: #1088c8;
            --shadow: 0 18px 50px rgba(38, 45, 68, 0.08);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: Poppins, sans-serif;
            color: var(--ink);
            background: #ffffff;
            overflow: hidden;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            position: relative;
        }

        .countdown-display {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            background: #ffffff;
            z-index: 100;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .countdown-display.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .countdown-number {
            font-size: 8rem;
            font-weight: 800;
            color: #1088c8;
            line-height: 1;
            animation: pulse-out 1s ease-in forwards;
        }

        .countdown-number.fade-out {
            animation: fade-out-number 0.8s ease-in forwards;
        }

        @keyframes pulse-out {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fade-out-number {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(0.8);
                opacity: 0;
            }
        }

        .test-content {
            width: 100%;
            display: grid;
            place-items: center;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .test-content.show {
            opacity: 1;
        }

        .test-stage {
            text-align: center;
        }

        .stage-label {
            color: #5d6476;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .stage-image {
            max-width: 600px;
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .countdown-number {
                font-size: 6rem;
            }

            .stage-label {
                font-size: 1rem;
            }

            .stage-image {
                max-width: 400px;
            }
        }

        @media (max-width: 480px) {
            .countdown-number {
                font-size: 4rem;
            }

            .page {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="countdown-display" id="countdownDisplay">
            <div class="countdown-number" id="countdownNumber">3</div>
        </div>

        <div class="test-content" id="testContent">
            <div class="test-stage">
                <p class="stage-label">Tahap Kedua - Identifikasi Nama Buah</p>
                <img class="stage-image" src="{{ asset('images/Tahap2.png') }}" alt="Tahap 2">
            </div>
        </div>
    </main>

    <script>
        const countdownDisplay = document.getElementById('countdownDisplay');
        const countdownNumber = document.getElementById('countdownNumber');
        const testContent = document.getElementById('testContent');

        let currentCount = 3;

        const updateCountdown = () => {
            if (currentCount > 0) {
                countdownNumber.textContent = currentCount;
                countdownNumber.classList.remove('fade-out');
                currentCount--;
                setTimeout(updateCountdown, 1000);
            } else {
                // Countdown selesai, tampil gambar tahap 2
                countdownNumber.classList.add('fade-out');
                setTimeout(() => {
                    countdownDisplay.classList.add('hidden');
                    testContent.classList.add('show');
                }, 800);
            }
        };

        // Mulai countdown setelah halaman load
        window.addEventListener('load', () => {
            setTimeout(updateCountdown, 500);
        });

        // Fallback jika load event sudah lewat
        if (document.readyState === 'complete') {
            setTimeout(updateCountdown, 500);
        }
    </script>
</body>
</html>
