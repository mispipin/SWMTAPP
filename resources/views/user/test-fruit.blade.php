<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahap Buah - Spatial Working Memory Test</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,600,1,0" rel="stylesheet">
    <style>
        :root {
            --ink: #1e2644;
            --accent: #1088c8;
            --shadow: 0 18px 50px rgba(38, 45, 68, 0.08);
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
            padding: 28px 16px 22px;
        }

        .test-shell {
            width: min(1000px, 100%);
            background: rgba(255, 255, 255, 0.56);
            border: 1px solid rgba(255, 255, 255, 0.52);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
            padding: 26px 20px 22px;
        }

        .progress-bar-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .progress-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #e8f1f8;
            color: var(--ink);
            font-size: 0.92rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .progress-label .material-symbols-rounded {
            font-size: 0.95rem;
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
        }

        .progress-fill-container {
            flex: 1;
            height: 7px;
            background: #d6d8dc;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: {{ ($currentStage / $totalStages) * 100 }}%;
            background: linear-gradient(90deg, #1493d2 0%, #0f86c3 100%);
            border-radius: 999px;
        }

        .fruit-card {
            width: min(310px, 100%);
            margin: 18px auto 0;
            background: #ffffff;
            border-radius: 20px;
            padding: 20px 18px 18px;
            text-align: center;
            box-shadow: 0 10px 24px rgba(26, 44, 71, 0.08);
        }

        .fruit-question {
            margin: 0 0 14px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--ink);
        }

        .fruit-image {
            width: min(190px, 100%);
            height: auto;
            display: block;
            margin: 0 auto 18px;
        }

        .choice-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .choice-btn {
            border: 0;
            border-radius: 6px;
            padding: 10px 8px;
            background: linear-gradient(180deg, #1493d2 0%, #0f86c3 100%);
            color: #ffffff;
            font-family: Poppins, sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }

        .choice-btn:hover {
            filter: brightness(1.03);
        }

        @media (max-width: 640px) {
            .test-shell {
                border-radius: 20px;
                padding: 16px 12px 14px;
            }

            .progress-label {
                font-size: 0.82rem;
            }

            .fruit-card {
                width: min(280px, 100%);
                padding: 16px 12px 14px;
            }

            .fruit-question {
                font-size: 0.92rem;
            }

            .fruit-image {
                width: min(160px, 100%);
            }

            .choice-btn {
                font-size: 0.82rem;
                padding: 9px 6px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="test-shell">
            <div class="progress-bar-container">
                <div class="progress-label">
                    <span class="material-symbols-rounded">bookmark</span>
                    Bagian {{ $currentStage }} dari {{ $totalStages }}
                </div>
                <div class="progress-fill-container">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <article class="fruit-card">
                <p class="fruit-question">Buah apakah ini?</p>
                <img class="fruit-image" src="{{ asset($fruitImage) }}" alt="Buah jeruk">

                <div class="choice-row">
                    <button class="choice-btn" type="button">JERUK</button>
                    <button class="choice-btn" type="button">APEL</button>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
