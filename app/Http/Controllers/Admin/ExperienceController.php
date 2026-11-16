<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;

class ExperienceController extends Controller
{
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        Experience::query()->create([
            ...$request->validated(),
            'sort_order' => (int) Experience::query()->max('sort_order') + 1,
        ]);

        return back()
            ->with('status', 'Pengalaman berhasil ditambahkan.')
            ->with('status_title', 'Pengalaman Ditambahkan');
    }

    public function update(StoreExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());

        return back()
            ->with('status', "Pengalaman {$experience->title} berhasil diperbarui.")
            ->with('status_title', 'Pengalaman Diperbarui');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return back()
            ->with('status', 'Pengalaman telah dihapus.')
            ->with('status_title', 'Pengalaman Dihapus');
    }
}
