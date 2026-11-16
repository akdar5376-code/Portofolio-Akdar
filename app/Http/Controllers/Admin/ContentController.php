<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request): View
    {
        $skills = Skill::query()->ordered()->get();
        $experiences = Experience::query()->ordered()->get();
        $educations = Education::query()->ordered()->get();

        return view('admin.content.index', [
            'skills' => $skills,
            'experiences' => $experiences,
            'educations' => $educations,
            'editingSkill' => $request->integer('edit_skill') !== 0
                ? $skills->firstWhere('id', $request->integer('edit_skill'))
                : null,
            'editingExperience' => $request->integer('edit_experience') !== 0
                ? $experiences->firstWhere('id', $request->integer('edit_experience'))
                : null,
            'editingEducation' => $request->integer('edit_education') !== 0
                ? $educations->firstWhere('id', $request->integer('edit_education'))
                : null,
        ]);
    }
}
