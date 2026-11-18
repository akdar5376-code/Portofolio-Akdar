<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.content.skills');
    }

    public function skills(Request $request): View
    {
        $skills = Skill::query()->ordered()->get();

        return view('admin.content.index', [
            'section' => 'skills',
            'skills' => $skills,
            'editingSkill' => $request->integer('edit_skill') !== 0
                ? $skills->firstWhere('id', $request->integer('edit_skill'))
                : null,
        ]);
    }

    public function experiences(Request $request): View
    {
        $experiences = Experience::query()->ordered()->get();

        return view('admin.content.index', [
            'section' => 'experiences',
            'experiences' => $experiences,
            'editingExperience' => $request->integer('edit_experience') !== 0
                ? $experiences->firstWhere('id', $request->integer('edit_experience'))
                : null,
        ]);
    }

    public function educations(Request $request): View
    {
        $educations = Education::query()->ordered()->get();

        return view('admin.content.index', [
            'section' => 'educations',
            'educations' => $educations,
            'editingEducation' => $request->integer('edit_education') !== 0
                ? $educations->firstWhere('id', $request->integer('edit_education'))
                : null,
        ]);
    }
}
