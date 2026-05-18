<?php

namespace App\Http\Controllers;

use App\Models\TeacherClass;
use App\Models\TestRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class UserRegistrationController extends Controller
{
    public function showForm(): View|RedirectResponse
    {
        return view('user.register-test');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'school' => ['required', 'string', 'max:255'],
            'class_code' => ['nullable', 'string', 'max:20'],
            'class_name' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
        ]);

        $teacherClassId = null;

        if (!empty($validated['class_code'])) {
            $teacherClass = TeacherClass::query()
                ->where('code', strtoupper(trim($validated['class_code'])))
                ->first();

            if (!$teacherClass) {
                return back()
                    ->withInput()
                    ->withErrors(['class_code' => 'Kode kelas tidak ditemukan. Silakan cek kembali kode dari guru.']);
            }
            $teacherClassId = $teacherClass->id;
        }

        $registration = TestRegistration::create([
            'school' => $validated['school'],
            'class_name' => $validated['class_name'],
            'name' => $validated['name'],
            'birth_date' => $validated['birth_date'],
            'address' => '-', 
            'teacher_class_id' => $teacherClassId,
        ]);

        return redirect()
            ->route('test.guide', $registration);
    }

    public function showGuide(TestRegistration $registration): View|RedirectResponse
    {
        return view('user.test-guide', compact('registration'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    public function startTest(TestRegistration $registration): View|RedirectResponse
    {

        // Scan folder People dan Buah untuk membentuk 15 bagian test.
        $peoplePath = public_path('images/People');
        $fruitPath = public_path('images/Buah');
        $images = [];
        $fruitFiles = [];
        
        if (is_dir($peoplePath)) {
            $files = array_diff(scandir($peoplePath), ['.', '..']);
            $images = array_values(array_filter($files, function ($file) use ($peoplePath) {
                return is_file($peoplePath . '/' . $file);
            }));
        }

        if (is_dir($fruitPath)) {
            $files = array_diff(scandir($fruitPath), ['.', '..']);
            $fruitFiles = array_values(array_filter($files, function ($file) use ($fruitPath) {
                return is_file($fruitPath . '/' . $file);
            }));
        }
        
        $currentStage = 1;
        $totalStages = 15;
        $sections = [];

        $formatFruitName = function (string $file): string {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $name = preg_replace('/[_\-]+/', ' ', $name);
            $name = preg_replace('/\s+/', ' ', trim($name));

            return strtoupper($name);
        };

        $fruitLabels = array_values(array_unique(array_map($formatFruitName, $fruitFiles)));

        $buildFruitSlide = function () use ($fruitFiles, $fruitLabels, $formatFruitName) {
            $defaultImage = 'images/Buah/Lemon.png';
            $selectedFile = !empty($fruitFiles) ? $fruitFiles[array_rand($fruitFiles)] : 'Lemon.png';
            $selectedImage = !empty($fruitFiles) ? 'images/Buah/' . $selectedFile : $defaultImage;
            $correctChoice = $formatFruitName($selectedFile);

            $wrongPool = array_values(array_filter($fruitLabels, function ($label) use ($correctChoice) {
                return $label !== $correctChoice;
            }));

            if (empty($wrongPool)) {
                $fallback = $correctChoice === 'APEL' ? 'MANGGA' : 'APEL';
                $wrongPool = [$fallback];
            }

            $wrongChoice = $wrongPool[array_rand($wrongPool)];
            $choices = [$correctChoice, $wrongChoice];
            shuffle($choices);

            return [
                'type' => 'fruit',
                'prompt' => 'Buah apakah ini?',
                'image' => $selectedImage,
                'choices' => $choices,
            ];
        };

        if (!empty($images)) {
            $relativeImages = array_map(function ($file) {
                return 'images/People/' . $file;
            }, $images);

            for ($stage = 1; $stage <= $totalStages; $stage++) {
                $shuffledPeople = $relativeImages;
                shuffle($shuffledPeople);
                $recallTargets = array_slice($shuffledPeople, 0, min(2, count($shuffledPeople)));

                if (count($recallTargets) < 2) {
                    while (count($recallTargets) < 2) {
                        $recallTargets[] = $relativeImages[array_rand($relativeImages)];
                    }
                }

                $stageSlides = [];

                // Orang-buah diulang 2x: [orang, buah, orang, buah]
                for ($cycle = 0; $cycle < 2; $cycle++) {
                    $stageSlides[] = [
                        'type' => 'person',
                        'prompt' => 'Ingat wajah dibawah ini!',
                        'image' => $recallTargets[$cycle],
                    ];
                    $stageSlides[] = $buildFruitSlide();
                }

                $recallPool = array_values(array_unique(array_merge($recallTargets, $relativeImages)));
                $recallPool = array_values(array_filter($recallPool, function ($image) use ($recallTargets) {
                    return !in_array($image, $recallTargets, true);
                }));

                shuffle($recallPool);
                $distractors = array_slice($recallPool, 0, 4);
                $recallOptions = array_values(array_unique(array_merge($recallTargets, $distractors)));
                shuffle($recallOptions);

                $sections[] = [
                    'slides' => $stageSlides,
                    'recall_targets' => $recallTargets,
                    'recall_options' => $recallOptions,
                ];
            }
        } else {
            for ($stage = 1; $stage <= $totalStages; $stage++) {
                $stageSlides = [];
                for ($cycle = 0; $cycle < 4; $cycle++) {
                    $stageSlides[] = $buildFruitSlide();
                }

                $sections[] = [
                    'slides' => $stageSlides,
                    'recall_targets' => [],
                    'recall_options' => [],
                ];
            }
        }

        $firstSection = $sections[0] ?? ['slides' => []];
        $firstSlide = $firstSection['slides'][0] ?? null;
        $randomImage = $firstSlide['image'] ?? null;
        $stagePrompt = $firstSlide['prompt'] ?? 'Ingat gambar dibawah ini!';
        
        return view('user.test-display-new', compact(
            'registration',
            'randomImage',
            'currentStage',
            'totalStages',
            'sections',
            'stagePrompt',
        ));
    }

    public function showFruitStage(TestRegistration $registration): View|RedirectResponse
    {
        $currentStage = 1;
        $totalStages = 15;
        $fruitImage = 'images/Buah/Jeruk.png';

        return view('user.test-fruit', compact('registration', 'currentStage', 'totalStages', 'fruitImage'));
    }

    public function showResult(Request $request, TestRegistration $registration): View|RedirectResponse
    {
        // Jika data sudah ada di database (sudah pernah disave), gunakan data tersebut.
        // Jika belum ada, ambil dari query parameter dan simpan ke database.
        
        if ($registration->total_poin !== null && !$request->has('total_poin')) {
            $totalPoin = $registration->total_poin;
            $orangBenar = $registration->orang_benar;
            $urutanBenar = $registration->urutan_benar;
            $orangSalah = $registration->orang_salah;
            $urutanSalah = $registration->urutan_salah;
            $totalBagian = 15; // Default
        } else {
            $totalBagian = max(1, (int) $request->query('total_bagian', 15));
            $maksOrang = $totalBagian * 2;

            $orangBenar = max(0, min($maksOrang, (int) $request->query('orang_benar', 0)));
            $urutanBenar = max(0, min($orangBenar, (int) $request->query('urutan_benar', 0)));

            $orangSalah = max(0, $maksOrang - $orangBenar);
            $urutanSalah = max(0, $orangBenar - $urutanBenar);

            $totalPoin = max(0, min($totalBagian * 20, (int) $request->query('total_poin', 0)));

            // Hanya update jika poin belum disave atau jika ini adalah hit pertama dari test yang baru selesai
            $registration->update([
                'orang_benar' => $orangBenar,
                'urutan_benar' => $urutanBenar,
                'orang_salah' => $orangSalah,
                'urutan_salah' => $urutanSalah,
                'total_poin' => $totalPoin,
                'tested_at' => now(),
            ]);
        }

        $kategori = $this->getKategori($totalPoin);
        $kategoriSkor = $kategori['kategori'];
        $deskripsiKategori = $kategori['deskripsi'];

        return view('user.test-result', compact(
            'registration',
            'orangBenar',
            'urutanBenar',
            'orangSalah',
            'urutanSalah',
            'totalPoin',
            'totalBagian',
            'kategoriSkor',
            'deskripsiKategori'
        ));
    }

    public function exportResultPdf(TestRegistration $registration)
    {
        // Izinkan download PDF tanpa login selama data test sudah ada
        if ($registration->total_poin === null) {
            abort(404, 'Data test belum tersedia.');
        }

        $kategori = $this->getKategori($registration->total_poin);
        
        $pdf = Pdf::loadView('user.result-pdf', [
            'registration' => $registration,
            'kategori' => $kategori['kategori'],
            'deskripsi' => $kategori['deskripsi']
        ]);

        return $pdf->download('Hasil_Test_SWMT_' . Str::slug($registration->name) . '.pdf');
    }

    private function getKategori(?int $poin): array
    {
        $kategoriSkor = 'Perlu Latihan';
        $deskripsiKategori = 'Kemampuan memori spasial masih perlu banyak ditingkatkan';

        if ($poin >= 261) {
            $kategoriSkor = 'Luar Biasa';
            $deskripsiKategori = 'Kemampuan memori spasial sangat kuat dan cepat';
        } elseif ($poin >= 221) {
            $kategoriSkor = 'Sangat Baik';
            $deskripsiKategori = 'Sudah di atas rata-rata, cukup akurat dalam mengingat';
        } elseif ($poin >= 181) {
            $kategoriSkor = 'Baik';
            $deskripsiKategori = 'Kemampuan memori cukup bagus dan stabil';
        } elseif ($poin >= 121) {
            $kategoriSkor = 'Cukup';
            $deskripsiKategori = 'Sudah mulai memahami, tapi masih belum konsisten';
        }

        return [
            'kategori' => $kategoriSkor,
            'deskripsi' => $deskripsiKategori
        ];
    }

    private function studentLoggedIn(): bool
    {
        $user = Auth::user();

        return (bool) $user && $user->role === 'student';
    }
}
