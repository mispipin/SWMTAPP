<?php

namespace App\Http\Controllers;

use App\Models\TeacherClass;
use App\Models\TestRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRegistrationController extends Controller
{
    public function adminIndex(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->requireAdmin($request)) {
            return $redirect;
        }

        $teacher = Auth::user();
        $searchClasses = trim((string) $request->query('q_classes', ''));
        $teacherClasses = TeacherClass::query()
            ->where('user_id', $teacher->id)
            ->when($searchClasses !== '', function ($query) use ($searchClasses) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . request('q_classes') . '%')
                        ->orWhere('code', 'like', '%' . request('q_classes') . '%');
                });
            })
            ->latest()
            ->paginate(2, ['*'], 'classes_page');

        $search = trim((string) $request->query('q', ''));
        $selectedClassId = $request->query('class_id');
        
        $registrations = TestRegistration::query()
            ->whereHas('teacherClass', function ($query) use ($teacher) {
                $query->where('user_id', $teacher->id);
            })
            ->when($selectedClassId, function ($query) use ($selectedClassId) {
                $query->where('teacher_class_id', $selectedClassId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('school', 'like', '%' . $search . '%')
                        ->orWhere('class_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('admin.users', [
            'registrations' => $registrations,
            'search' => $search,
            'searchClasses' => $searchClasses,
            'selectedClassId' => $selectedClassId,
            'teacherClasses' => $teacherClasses,
        ]);
    }

    public function storeClass(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $code = strtoupper(Str::random(6));

        while (TeacherClass::where('code', $code)->exists()) {
            $code = strtoupper(Str::random(6));
        }

        TeacherClass::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'code' => $code,
        ]);

        return redirect()
            ->route('teacher.dashboard')
            ->with('success', 'Kelas berhasil dibuat. Kode kelas: ' . $code);
    }

    public function destroyClass(Request $request, TeacherClass $teacherClass): RedirectResponse
    {
        if ($redirect = $this->requireAdmin($request)) {
            return $redirect;
        }

        $teacher = Auth::user();

        if ($teacherClass->user_id !== $teacher->id) {
            abort(403);
        }

        $teacherClass->delete();

        return redirect()
            ->route('teacher.dashboard')
            ->with('success', 'Kelas berhasil dihapus.');
    }

    public function edit(Request $request, TestRegistration $registration): View|RedirectResponse
    {
        if ($redirect = $this->requireAdmin($request)) {
            return $redirect;
        }

        return view('admin.edit-registration', [
            'registration' => $registration,
        ]);
    }

    public function update(Request $request, TestRegistration $registration): RedirectResponse|View
    {
        if ($redirect = $this->requireAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'school' => ['required', 'string', 'max:255'],
            'class_name' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
        ]);

        $registration->update($validated);

        return redirect()
            ->route('teacher.dashboard')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy(TestRegistration $registration): RedirectResponse
    {
        $registration->delete();
        return redirect()->route('teacher.dashboard')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $teacher = Auth::user();
        if (!$teacher) {
            abort(403);
        }

        $selectedClassId = $request->query('class_id');
        $search = trim((string) $request->query('q', ''));

        $registrations = TestRegistration::query()
            ->whereHas('teacherClass', function ($query) use ($teacher) {
                $query->where('user_id', $teacher->id);
            })
            ->when($selectedClassId, function ($query) use ($selectedClassId) {
                $query->where('teacher_class_id', $selectedClassId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('school', 'like', '%' . $search . '%')
                        ->orWhere('class_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        $className = null;
        if ($selectedClassId) {
            $class = TeacherClass::where('id', $selectedClassId)
                ->where('user_id', $teacher->id)
                ->first();
            $className = $class ? $class->name : null;
        }

        $pdf = Pdf::loadView('admin.export-pdf', [
            'registrations' => $registrations,
            'className' => $className
        ]);

        $filename = 'Data_Siswa_SWMT';
        if ($className) {
            $filename .= '_' . Str::slug($className);
        }
        $filename .= '_' . now()->format('YmdHis') . '.pdf';

        return $pdf->download($filename);
    }

    public function editProfile(): View|RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('teacher.login');
        }

        return view('admin.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('teacher.login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }

    private function requireAdmin(Request $request): ?RedirectResponse
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            Auth::logout();

            return redirect()->route('teacher.login')->withErrors([
                'login' => 'Silakan login guru terlebih dahulu.',
            ]);
        }

        return null;
    }
}
