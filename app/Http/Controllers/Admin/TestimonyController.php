<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TestimonyRole;
use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index(Request $request): View
    {
        $role = TestimonyRole::tryFrom((string) $request->query('role'));

        $testimonies = Testimony::query()
            ->ofRole($role)
            ->ordered()
            ->get();

        return view('admin.testimonies.index', [
            'testimonies' => $testimonies,
            'roles' => TestimonyRole::cases(),
            'activeRole' => $role,
            'total' => Testimony::query()->count(),
        ]);
    }

    public function toggleVisibility(Testimony $testimony): RedirectResponse
    {
        $testimony->update(['is_visible' => ! $testimony->is_visible]);

        $state = $testimony->is_visible ? 'ditampilkan' : 'disembunyikan';

        return back()
            ->with('status', "Testimoni dari {$testimony->name} berhasil {$state}.")
            ->with('status_title', 'Testimoni Diperbarui');
    }

    public function destroy(Testimony $testimony): RedirectResponse
    {
        $testimony->delete();

        return back()
            ->with('status', "Testimoni dari {$testimony->name} telah dihapus.")
            ->with('status_title', 'Testimoni Dihapus');
    }
}
