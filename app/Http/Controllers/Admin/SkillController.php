<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;

class SkillController extends Controller
{
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        Skill::query()->create([
            ...$request->validated(),
            'sort_order' => (int) Skill::query()->max('sort_order') + 1,
        ]);

        return back()
            ->with('status', 'Keahlian berhasil ditambahkan.')
            ->with('status_title', 'Keahlian Ditambahkan');
    }

    public function update(StoreSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());

        return back()
            ->with('status', "Keahlian {$skill->name} berhasil diperbarui.")
            ->with('status_title', 'Keahlian Diperbarui');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return back()
            ->with('status', 'Keahlian telah dihapus.')
            ->with('status_title', 'Keahlian Dihapus');
    }
}
