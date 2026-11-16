<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;

class EducationController extends Controller
{
    public function store(StoreEducationRequest $request): RedirectResponse
    {
        Education::query()->create([
            ...$request->validated(),
            'sort_order' => (int) Education::query()->max('sort_order') + 1,
        ]);

        return back()
            ->with('status', 'Riwayat pendidikan berhasil ditambahkan.')
            ->with('status_title', 'Pendidikan Ditambahkan');
    }

    public function update(StoreEducationRequest $request, Education $education): RedirectResponse
    {
        $education->update($request->validated());

        return back()
            ->with('status', "{$education->institution} berhasil diperbarui.")
            ->with('status_title', 'Pendidikan Diperbarui');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return back()
            ->with('status', 'Riwayat pendidikan telah dihapus.')
            ->with('status_title', 'Pendidikan Dihapus');
    }
}
