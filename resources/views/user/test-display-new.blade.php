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
            --accent: #1088c8;
            --shadow: 0 18px 50px rgba(38, 45, 68, 0.08);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }

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
            position: relative;
        }

        .countdown-display {
            position: fixed;
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
            color: var(--accent);
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

        .test-shell {
            width: min(800px, 100%);
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
            padding: 32px 28px 28px;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .test-shell.show {
            opacity: 1;
        }

        .progress-bar-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .progress-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #e8f1f8;
            color: var(--ink);
            font-size: 0.84rem;
            font-weight: 500;
            white-space: nowrap;
        }

        #progressText {
            font-weight: 600;
        }

        .progress-label .material-symbols-rounded {
            font-size: 1rem;
        }

        .progress-fill-container {
            flex: 1;
            height: 6px;
            background: #e0e0e0;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0a5a84 0%, #074565 100%);
            border-radius: 999px;
            transition: width 0.55s ease;
        }

        .test-content {
            text-align: center;
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.45s ease, transform 0.45s ease;
            will-change: opacity, transform;
        }

        .test-content.is-switching {
            opacity: 0;
            transform: translateY(8px);
        }

        .next-button-wrap {
            display: flex;
            justify-content: flex-end;
            margin-top: 4px;
        }

        .face-prompt {
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .face-image-container {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }

        .face-image {
            max-width: 190px;
            width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(31, 41, 55, 0.1);
            object-fit: cover;
        }

        .fruit-card {
            width: min(310px, 100%);
            margin: 0 auto 14px;
            background: #ffffff;
            border-radius: 20px;
            padding: 20px 18px 18px;
            text-align: center;
            box-shadow: 0 10px 24px rgba(26, 44, 71, 0.08);
            display: none;
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
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #ffffff;
            font-family: Poppins, sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }

        .choice-btn:hover {
            filter: brightness(0.9);
        }

        .recall-stage {
            display: none;
            text-align: left;
        }

        .recall-instruction {
            margin: 6px 0 14px;
            text-align: center;
            font-size: 1rem;
            font-weight: 500;
            color: var(--ink);
        }

        .recall-picked {
            min-height: 96px;
            border-radius: 12px;
            background: #f2f3f5;
            padding: 10px;
            margin-bottom: 14px;
        }

        .picked-label {
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            background: #9ec6f4;
            color: #1f3a60;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 6px;
            margin-bottom: 8px;
        }

        .picked-list {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .picked-item {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid rgba(16, 136, 200, 0.25);
        }

        .recall-options {
            display: grid;
            grid-template-columns: repeat(6, minmax(80px, 1fr));
            gap: 10px;
        }

        .recall-option {
            border: 0;
            padding: 0;
            background: transparent;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            box-shadow: 0 2px 8px rgba(31, 41, 55, 0.12);
        }

        .recall-option img {
            width: 100%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            display: block;
        }

        .recall-option.is-selected::after {
            content: attr(data-order);
            position: absolute;
            top: 6px;
            right: 6px;
            width: 20px;
            height: 20px;
            border-radius: 999px;
            background: #1088c8;
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            display: grid;
            place-items: center;
        }

        .section-score-stage {
            display: none;
            text-align: center;
        }

        .section-score-title {
            margin: 0 0 12px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
        }

        .section-score-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(120px, 1fr));
            gap: 10px;
            margin-bottom: 14px;
        }

        .section-score-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 10px 8px;
            box-shadow: 0 8px 18px rgba(27, 42, 68, 0.08);
        }

        .section-score-label {
            margin: 0 0 8px;
            font-size: 0.76rem;
            font-weight: 600;
            color: #34445f;
        }

        .section-score-value {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ink);
        }

        .section-total-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 14px;
            margin-bottom: 14px;
            background: #d5f0dc;
            color: #0f9a2c;
            font-size: 0.98rem;
            font-weight: 700;
        }

        .section-continue-btn {
            border: 0;
            border-radius: 999px;
            padding: 10px 20px;
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #fff;
            font-family: Poppins, sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(18, 133, 195, 0.24);
        }

        .next-button {
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0;
            padding: 10px 36px 10px 18px;
            border: 0;
            border-radius: 7px;
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #fff;
            font-family: Poppins, sans-serif;
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 8px 20px rgba(18, 133, 195, 0.24);
            position: relative;
        }

        .next-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(18, 133, 195, 0.32);
        }

        .next-button .material-symbols-rounded {
            font-size: 1.05rem;
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 600, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }

        .home-float {
            position: fixed;
            right: 18px;
            bottom: 18px;
            width: 46px;
            height: 46px;
            border-radius: 999px;
            border: 0;
            display: grid;
            place-items: center;
            background: linear-gradient(180deg, #0a5a84 0%, #074565 100%);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(18, 133, 195, 0.28);
            z-index: 120;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .home-float:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(18, 133, 195, 0.34);
        }

        .home-float .material-symbols-rounded {
            font-size: 1.18rem;
            font-variation-settings: 'FILL' 1, 'wght' 650, 'GRAD' 0, 'opsz' 24;
        }

        @media (max-width: 768px) {
            .countdown-number {
                font-size: 6rem;
            }

            .test-shell {
                padding: 24px 20px 20px;
            }

            .face-prompt {
                font-size: 0.92rem;
                margin-bottom: 18px;
            }

            .face-image {
                max-width: 160px;
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

            .recall-options {
                grid-template-columns: repeat(3, minmax(80px, 1fr));
            }

            .recall-instruction {
                font-size: 0.92rem;
            }

            .section-score-grid {
                grid-template-columns: repeat(2, minmax(120px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .countdown-number {
                font-size: 4rem;
            }

            .page {
                padding: 18px 12px 18px;
            }

            .test-shell {
                padding: 18px 16px 16px;
                border-radius: 20px;
            }

            .progress-label {
                font-size: 0.76rem;
            }

            .face-prompt {
                font-size: 0.86rem;
                margin-bottom: 14px;
            }

            .face-image {
                max-width: 130px;
                border-radius: 14px;
            }

            .face-image-container {
                margin-bottom: 16px;
            }

            .next-button {
                padding: 8px 30px 8px 14px;
                font-size: 0.86rem;
            }

            .next-button .material-symbols-rounded {
                font-size: 0.95rem;
                right: 10px;
            }

            .next-button-wrap {
                margin-top: 2px;
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
        <div class="countdown-display" id="countdownDisplay">
            <div class="countdown-number" id="countdownNumber">3</div>
        </div>

        <div class="test-shell" id="testShell">
            <div class="progress-bar-container">
                <div class="progress-label">
                    <span class="material-symbols-rounded">bookmark</span>
                    <span id="progressText">Bagian {{ $currentStage }} dari {{ $totalStages }}</span>
                </div>
                <div class="progress-fill-container">
                    <div class="progress-fill" id="progressFill" style="width: {{ ($currentStage / $totalStages) * 100 }}%;"></div>
                </div>
            </div>

            <div class="test-content">
                <div id="personSection">
                    <p class="face-prompt" id="stagePrompt">{{ $stagePrompt }}</p>

                    <div class="face-image-container">
                        <img
                            class="face-image"
                            id="faceImage"
                            src="{{ $randomImage ? asset($randomImage) : '' }}"
                            alt="Wajah"
                            style="display: {{ $randomImage ? 'block' : 'none' }};"
                        >
                        <div
                            id="faceFallback"
                            style="width: 190px; height: 225px; background: #e0e0e0; border-radius: 16px; display: {{ $randomImage ? 'none' : 'grid' }}; place-items: center; color: #999;"
                        >
                            Gambar tidak tersedia
                        </div>
                    </div>

                    <div class="next-button-wrap">
                        <button class="next-button" type="button" onclick="nextStage()">
                            Next
                            <span class="material-symbols-rounded">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <article class="fruit-card" id="fruitCard">
                    <p class="fruit-question" id="fruitQuestion">Buah apakah ini?</p>
                    <img class="fruit-image" id="fruitImage" src="" alt="Gambar buah" style="display: none;">

                    <div class="choice-row" id="choiceRow"></div>
                </article>

                <section class="recall-stage" id="recallStage">
                    <p class="recall-instruction" id="recallInstruction">Klik wajah sesuai urutan yang tadi ditampilkan! (0/2)</p>

                    <div class="recall-picked">
                        <span class="picked-label">Urutan yang dipilih</span>
                        <div class="picked-list" id="pickedList"></div>
                    </div>

                    <div class="recall-options" id="recallOptions"></div>

                    <div id="recallConfirmWrap" style="text-align: center; margin-top: 24px; display: none;">
                        <button class="next-button" type="button" id="recallConfirmBtn">
                            Konfirmasi Jawaban
                            <span class="material-symbols-rounded">check_circle</span>
                        </button>
                    </div>
                </section>

                <section class="section-score-stage" id="sectionScoreStage">
                    <p class="section-score-title" id="sectionScoreTitle">Skor Bagian 1</p>

                    <div class="section-score-grid">
                        <article class="section-score-card">
                            <p class="section-score-label">Orang Benar</p>
                            <p class="section-score-value" id="scoreOrangBenar">0</p>
                        </article>
                        <article class="section-score-card">
                            <p class="section-score-label">Urutan Benar</p>
                            <p class="section-score-value" id="scoreUrutanBenar">0</p>
                        </article>
                        <article class="section-score-card">
                            <p class="section-score-label">Orang Salah</p>
                            <p class="section-score-value" id="scoreOrangSalah">0</p>
                        </article>
                        <article class="section-score-card">
                            <p class="section-score-label">Urutan Salah</p>
                            <p class="section-score-value" id="scoreUrutanSalah">0</p>
                        </article>
                    </div>

                    <div class="section-total-pill">
                        Skor Bagian: <span id="scoreBagianPoin">0 Poin</span>
                    </div>

                    <div>
                        <button class="section-continue-btn" type="button" id="sectionContinueBtn">Lanjut Bagian 2</button>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script>
        const countdownDisplay = document.getElementById('countdownDisplay');
        const countdownNumber = document.getElementById('countdownNumber');
        const testShell = document.getElementById('testShell');
        const progressText = document.getElementById('progressText');
        const progressFill = document.getElementById('progressFill');
        const faceImage = document.getElementById('faceImage');
        const faceFallback = document.getElementById('faceFallback');
        const stagePrompt = document.getElementById('stagePrompt');
        const personSection = document.getElementById('personSection');
        const fruitCard = document.getElementById('fruitCard');
        const fruitQuestion = document.getElementById('fruitQuestion');
        const fruitImage = document.getElementById('fruitImage');
        const choiceRow = document.getElementById('choiceRow');
        const testContent = document.querySelector('.test-content');
        const recallStage = document.getElementById('recallStage');
        const recallInstruction = document.getElementById('recallInstruction');
        const recallOptions = document.getElementById('recallOptions');
        const pickedList = document.getElementById('pickedList');
        const sectionScoreStage = document.getElementById('sectionScoreStage');
        const sectionScoreTitle = document.getElementById('sectionScoreTitle');
        const scoreOrangBenar = document.getElementById('scoreOrangBenar');
        const scoreUrutanBenar = document.getElementById('scoreUrutanBenar');
        const scoreOrangSalah = document.getElementById('scoreOrangSalah');
        const scoreUrutanSalah = document.getElementById('scoreUrutanSalah');
        const scoreBagianPoin = document.getElementById('scoreBagianPoin');
        const sectionContinueBtn = document.getElementById('sectionContinueBtn');

        const totalStages = {{ $totalStages }};
        const sections = @json($sections ?? []);
        const resultBaseUrl = @json(route('test.result', $registration));
        const storageKey = `swmt_resume_{{ $registration->id }}`;
        let currentSectionIndex = {{ max(0, $currentStage - 1) }};
        let currentSlideIndex = 0;
        let isTransitioning = false;
        let pickedOrder = [];
        let sectionResults = [];
        let isSubmittingResult = false;
        let countdownTimer = null;
        let hasStartedFlow = false;

        const saveProgress = () => {
            const data = {
                currentSectionIndex,
                sectionResults,
                sections,
            };
            localStorage.setItem(storageKey, JSON.stringify(data));
        };

        const clearProgress = () => {
            localStorage.removeItem(storageKey);
        };

        const tryResume = () => {
            const saved = localStorage.getItem(storageKey);
            if (!saved) return false;
            
            try {
                const data = JSON.parse(saved);
                if (data.currentSectionIndex >= totalStages) {
                    clearProgress();
                    return false;
                }
                
                // Override local variables
                currentSectionIndex = data.currentSectionIndex;
                sectionResults = data.sectionResults || [];
                // Penting: timpa sections agar urutan gambar tidak berubah saat refresh
                if (data.sections && data.sections.length > 0) {
                    sections.splice(0, sections.length, ...data.sections);
                }
                
                console.log('Resuming from section', currentSectionIndex + 1);
                return true;
            } catch (e) {
                console.error('Error resuming:', e);
                return false;
            }
        };

        const saveProgress = () => {
            const data = {
                currentSectionIndex,
                sectionResults,
                sections,
            };
            localStorage.setItem(storageKey, JSON.stringify(data));
        };

        const clearProgress = () => {
            localStorage.removeItem(storageKey);
        };

        const tryResume = () => {
            const saved = localStorage.getItem(storageKey);
            if (!saved) return false;
            
            try {
                const data = JSON.parse(saved);
                if (data.currentSectionIndex >= totalStages) {
                    clearProgress();
                    return false;
                }
                
                // Override local variables
                currentSectionIndex = data.currentSectionIndex;
                sectionResults = data.sectionResults || [];
                // Penting: timpa sections agar urutan gambar tidak berubah saat refresh
                if (data.sections && data.sections.length > 0) {
                    sections.splice(0, sections.length, ...data.sections);
                }
                
                console.log('Resuming from section', currentSectionIndex + 1);
                return true;
            } catch (e) {
                console.error('Error resuming:', e);
                return false;
            }
        };

        const startSectionCountdown = () => {
            if (countdownTimer) {
                clearTimeout(countdownTimer);
                countdownTimer = null;
            }

            let currentCount = 3;
            countdownDisplay.classList.remove('hidden');
            countdownNumber.classList.remove('fade-out');
            countdownNumber.textContent = String(currentCount);

            const tickCountdown = () => {
                if (currentCount > 0) {
                    countdownNumber.textContent = String(currentCount);
                    countdownNumber.classList.remove('fade-out');
                    currentCount -= 1;
                    countdownTimer = setTimeout(tickCountdown, 1000);
                    return;
                }

                countdownNumber.classList.add('fade-out');
                countdownTimer = setTimeout(() => {
                    countdownDisplay.classList.add('hidden');
                    testShell.classList.add('show');
                    updateStageUI();
                }, 800);
            };

            tickCountdown();
        };

        const getCurrentSection = () => {
            return sections[currentSectionIndex] || {
                slides: [],
                recall_targets: [],
                recall_options: [],
            };
        };

        const computeSectionPoints = (orangBenar, urutanBenar) => {
            if (orangBenar === 2 && urutanBenar === 2) {
                return 20;
            }

            if (orangBenar === 2) {
                return 15;
            }

            if (orangBenar === 1 && urutanBenar === 1) {
                return 10;
            }

            if (orangBenar === 1) {
                return 5;
            }

            return 0;
        };

        const animateSectionTransition = (onSwitch) => {
            if (isTransitioning) {
                return;
            }

            isTransitioning = true;
            testContent.classList.add('is-switching');

            setTimeout(() => {
                onSwitch();
                updateStageUI();

                requestAnimationFrame(() => {
                    testContent.classList.remove('is-switching');
                });

                setTimeout(() => {
                    isTransitioning = false;
                }, 450);
            }, 260);
        };

        const updateStageUI = () => {
            const stageNumber = currentSectionIndex + 1;
            progressText.textContent = `Bagian ${stageNumber} dari ${totalStages}`;
            progressFill.style.width = `${(stageNumber / totalStages) * 100}%`;

            const section = getCurrentSection();
            const slideSequence = Array.isArray(section.slides) ? section.slides : [];

            if (currentSlideIndex >= slideSequence.length) {
                renderRecallStage(section);
                return;
            }

            const currentSlide = slideSequence[currentSlideIndex] || null;
            const nextImage = currentSlide ? currentSlide.image : null;
            const nextPrompt = currentSlide ? currentSlide.prompt : 'Ingat gambar dibawah ini!';
            const isFruitSlide = currentSlide && currentSlide.type === 'fruit';

            if (isFruitSlide) {
                personSection.style.display = 'none';
                fruitCard.style.display = 'block';
                recallStage.style.display = 'none';
                sectionScoreStage.style.display = 'none';

                fruitQuestion.textContent = nextPrompt;
                fruitImage.src = nextImage ? `/${nextImage}` : '';
                fruitImage.style.display = nextImage ? 'block' : 'none';

                const choices = Array.isArray(currentSlide.choices) ? currentSlide.choices : [];
                choiceRow.innerHTML = '';
                choices.forEach((choice) => {
                    const button = document.createElement('button');
                    button.className = 'choice-btn';
                    button.type = 'button';
                    button.textContent = choice;
                    button.addEventListener('click', () => {
                        chooseFruitOption();
                    });
                    choiceRow.appendChild(button);
                });
                return;
            }

            personSection.style.display = 'block';
            fruitCard.style.display = 'none';
            recallStage.style.display = 'none';
            sectionScoreStage.style.display = 'none';
            stagePrompt.textContent = nextPrompt;

            if (nextImage) {
                faceImage.src = `/${nextImage}`;
                faceImage.style.display = 'block';
                faceFallback.style.display = 'none';
            } else {
                faceImage.style.display = 'none';
                faceFallback.style.display = 'grid';
            }
        };

        const updatePickedSummary = (targets) => {
            recallInstruction.textContent = `Klik wajah sesuai urutan yang tadi ditampilkan! (${pickedOrder.length}/2)`;

            pickedList.innerHTML = pickedOrder.map((imagePath) => (
                `<img class="picked-item" src="/${imagePath}" alt="Pilihan wajah" style="cursor:pointer" title="Klik untuk hapus" onclick="handlePickedClick('${imagePath}')">`
            )).join('');

            const optionButtons = recallOptions.querySelectorAll('.recall-option');
            optionButtons.forEach((button) => {
                const imagePath = button.getAttribute('data-image');
                const index = pickedOrder.indexOf(imagePath);
                if (index >= 0) {
                    button.classList.add('is-selected');
                    button.setAttribute('data-order', String(index + 1));
                } else {
                    button.classList.remove('is-selected');
                    button.removeAttribute('data-order');
                }
            });

            const confirmWrap = document.getElementById('recallConfirmWrap');
            if (pickedOrder.length === 2) {
                confirmWrap.style.display = 'block';
            } else {
                confirmWrap.style.display = 'none';
            }
        };

        window.handlePickedClick = (imagePath) => {
            if (isSubmittingResult) return;
            const section = getCurrentSection();
            const targets = Array.isArray(section.recall_targets) ? section.recall_targets : [];
            pickedOrder = pickedOrder.filter(img => img !== imagePath);
            updatePickedSummary(targets);
        };

        const submitFinalResult = () => {
            const orangBenarTotal = sectionResults.reduce((sum, item) => sum + item.orangBenar, 0);
            const urutanBenarTotal = sectionResults.reduce((sum, item) => sum + item.urutanBenar, 0);
            const totalPoin = sectionResults.reduce((sum, item) => sum + item.poin, 0);

            const query = new URLSearchParams({
                orang_benar: String(orangBenarTotal),
                urutan_benar: String(urutanBenarTotal),
                total_poin: String(totalPoin),
                total_bagian: String(totalStages),
            });

            clearProgress();
            window.location.href = `${resultBaseUrl}?${query.toString()}`;
        };

        const goToResultPage = () => {
            const orangBenarTotal = sectionResults.reduce((sum, item) => sum + item.orangBenar, 0);
            const urutanBenarTotal = sectionResults.reduce((sum, item) => sum + item.urutanBenar, 0);
            const totalPoin = sectionResults.reduce((sum, item) => sum + item.poin, 0);

            const query = new URLSearchParams({
                orang_benar: String(orangBenarTotal),
                urutan_benar: String(urutanBenarTotal),
                total_poin: String(totalPoin),
                total_bagian: String(totalStages),
            });

            clearProgress();
            window.location.href = `${resultBaseUrl}?${query.toString()}`;
        };

        window.goToResultPage = goToResultPage;

        const onRecallOptionClick = (imagePath, targets) => {
            if (isSubmittingResult) {
                return;
            }

            if (pickedOrder.includes(imagePath)) {
                // Deselect
                pickedOrder = pickedOrder.filter(img => img !== imagePath);
                updatePickedSummary(targets);
                return;
            }

            if (pickedOrder.length >= 2) {
                return;
            }

            pickedOrder.push(imagePath);
            updatePickedSummary(targets);
        };

        const confirmRecall = () => {
            if (isSubmittingResult || pickedOrder.length < 2) return;

            const section = getCurrentSection();
            const targets = Array.isArray(section.recall_targets) ? section.recall_targets : [];

            const orangBenar = pickedOrder.filter((image) => targets.includes(image)).length;
            const urutanBenar = pickedOrder.reduce((score, image, index) => {
                return score + (image === targets[index] ? 1 : 0);
            }, 0);
            const poin = computeSectionPoints(orangBenar, urutanBenar);
            sectionResults[currentSectionIndex] = { orangBenar, urutanBenar, poin };
            
            saveProgress(); // Simpan progres setiap kali selesai menjawab di satu bagian

            isSubmittingResult = true;

            setTimeout(() => {
                isSubmittingResult = false;
                showSectionScorePage(orangBenar, urutanBenar, poin);
            }, 500);
        };

        const showSectionScorePage = (orangBenar, urutanBenar, poin) => {
            const orangSalah = Math.max(0, 2 - orangBenar);
            const urutanSalah = Math.max(0, orangBenar - urutanBenar);
            const currentBagian = currentSectionIndex + 1;
            const isLastSection = currentBagian >= totalStages;

            personSection.style.display = 'none';
            fruitCard.style.display = 'none';
            recallStage.style.display = 'none';
            sectionScoreStage.style.display = 'block';

            sectionScoreTitle.textContent = `Skor Bagian ${currentBagian}`;
            scoreOrangBenar.textContent = String(orangBenar);
            scoreUrutanBenar.textContent = String(urutanBenar);
            scoreOrangSalah.textContent = String(orangSalah);
            scoreUrutanSalah.textContent = String(urutanSalah);
            scoreBagianPoin.textContent = `${poin} Poin`;

            sectionContinueBtn.textContent = isLastSection
                ? 'Lihat Hasil Akhir'
                : `Lanjut Bagian ${currentBagian + 1}`;

            sectionContinueBtn.onclick = () => {
                if (isLastSection) {
                    submitFinalResult();
                    return;
                }

                currentSectionIndex += 1;
                currentSlideIndex = 0;
                pickedOrder = [];
                startSectionCountdown();
            };
        };

        const renderRecallStage = (section) => {
            personSection.style.display = 'none';
            fruitCard.style.display = 'none';
            recallStage.style.display = 'block';
            sectionScoreStage.style.display = 'none';

            const recallTargets = Array.isArray(section.recall_targets) ? section.recall_targets : [];
            const recallPeopleOptions = Array.isArray(section.recall_options) ? section.recall_options : [];

            recallOptions.innerHTML = recallPeopleOptions.map((imagePath) => (
                `<button class="recall-option" type="button" data-image="${imagePath}">
                    <img src="/${imagePath}" alt="Opsi wajah">
                </button>`
            )).join('');

            const optionButtons = recallOptions.querySelectorAll('.recall-option');
            optionButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    onRecallOptionClick(button.getAttribute('data-image'), recallTargets);
                });
            });

            const confirmBtn = document.getElementById('recallConfirmBtn');
            confirmBtn.onclick = confirmRecall;

            updatePickedSummary(recallTargets);
        };

        const chooseFruitOption = () => {
            nextStage();
        };

        window.chooseFruitOption = chooseFruitOption;

        const nextStage = () => {
            const section = getCurrentSection();
            const slideSequence = Array.isArray(section.slides) ? section.slides : [];

            if (isTransitioning || currentSlideIndex >= slideSequence.length) {
                return;
            }

            animateSectionTransition(() => {
                currentSlideIndex += 1;
            });
        };

        const initTestFlow = () => {
            if (hasStartedFlow) {
                return;
            }

            hasStartedFlow = true;
            
            const wasResumed = tryResume();
            if (wasResumed) {
                console.log('Test resumed successfully');
            }
            
            setTimeout(startSectionCountdown, 500);
        };

        // Mulai countdown awal test
        window.addEventListener('load', initTestFlow);

        // Fallback jika load event sudah lewat
        if (document.readyState === 'complete') {
            initTestFlow();
        }
    </script>
</body>
</html>
