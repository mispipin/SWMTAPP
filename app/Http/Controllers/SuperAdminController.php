<?php

namespace App\Http\Controllers;

use App\Models\TeacherClass;
use App\Models\TestRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    private function requireSuperAdmin(): ?RedirectResponse
    {
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            return redirect()->route('teacher.login')->withErrors(['login' => 'Anda tidak memiliki akses ke halaman Super Admin.']);
        }
        return null;
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->requireSuperAdmin()) {
            return $redirect;
        }

        $search = trim((string) $request->query('q', ''));
        
        $totalTeachers = User::where('role', 'admin')->count();
        $totalClasses = TeacherClass::count();
        $totalStudents = TestRegistration::count();

        $registrations = TestRegistration::query()
            ->with(['teacherClass.teacher'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('school', 'like', '%' . $search . '%')
                        ->orWhere('class_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(15);

        return view('superadmin.dashboard', [
            'totalTeachers' => $totalTeachers,
            'totalClasses' => $totalClasses,
            'totalStudents' => $totalStudents,
            'registrations' => $registrations,
            'search' => $search,
        ]);
    }

    public function exportPdf(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $search = trim((string) $request->query('q', ''));

        $registrations = TestRegistration::query()
            ->with(['teacherClass.teacher'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('school', 'like', '%' . $search . '%')
                        ->orWhere('class_name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.export-pdf', [
            'registrations' => $registrations,
            'isSuperAdmin' => true
        ]);

        $filename = 'Laporan_Global_SWMT_' . now()->format('YmdHis') . '.pdf';
        return $pdf->download($filename);
    }
    public function destroy(TestRegistration $registration): RedirectResponse
    {
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $registration->delete();

        return redirect()->route('superadmin.dashboard')->with('success', 'Data siswa berhasil dihapus.');
    }
}
