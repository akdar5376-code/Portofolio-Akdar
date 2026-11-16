<?php

namespace App\Http\Controllers;

use App\Enums\SkillType;
use App\Enums\TestimonyRole;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimony;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $category = trim((string) $request->query('category')) ?: null;

        $projects = Project::query()
            ->ofCategory($category)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $skills = Skill::query()->ordered()->get();

        return view('portfolio.index', [
            'profile' => Profile::current(),
            'projects' => $projects,
            'categories' => Project::query()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'activeCategory' => $category,
            'hardSkills' => $skills->where('type', SkillType::Hard)->take(6),
            'softSkills' => $skills->where('type', SkillType::Soft)->take(4),
            'testimonies' => Testimony::query()->visible()->ordered()->take(4)->get(),
        ]);
    }

    public function about(): View
    {
        return view('portfolio.about', [
            'profile' => Profile::current(),
            'educations' => Education::query()->ordered()->get(),
            'experiences' => Experience::query()->ordered()->get(),
        ]);
    }

    public function skills(): View
    {
        $skills = Skill::query()->ordered()->get();

        return view('portfolio.skills', [
            'profile' => Profile::current(),
            'hardSkills' => $skills->where('type', SkillType::Hard)->values(),
            'softSkills' => $skills->where('type', SkillType::Soft)->values(),
        ]);
    }

    public function projects(Request $request): View
    {
        $category = trim((string) $request->query('category')) ?: null;
        $search = trim((string) $request->query('q'));

        $projects = Project::query()
            ->ofCategory($category)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('tech_stack', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('portfolio.projects.index', [
            'profile' => Profile::current(),
            'projects' => $projects,
            'categories' => Project::query()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'activeCategory' => $category,
            'search' => $search,
        ]);
    }

    public function showProject(Project $project): View
    {
        $related = Project::query()
            ->whereKeyNot($project->getKey())
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(3)
            ->get();

        return view('portfolio.projects.show', [
            'profile' => Profile::current(),
            'project' => $project,
            'related' => $related,
        ]);
    }

    public function certificates(): View
    {
        return view('portfolio.certificates', [
            'profile' => Profile::current(),
            'certificates' => Certificate::query()->ordered()->get(),
        ]);
    }

    public function experience(): View
    {
        return view('portfolio.experience', [
            'profile' => Profile::current(),
            'experiences' => Experience::query()->ordered()->get(),
        ]);
    }

    public function testimonies(): View
    {
        return view('portfolio.testimonies', [
            'profile' => Profile::current(),
            'roles' => TestimonyRole::cases(),
            'testimonies' => Testimony::query()->visible()->ordered()->get(),
        ]);
    }

    public function cv(): View
    {
        $skills = Skill::query()->ordered()->get();

        return view('portfolio.cv', [
            'profile' => Profile::current(),
            'educations' => Education::query()->ordered()->get(),
            'experiences' => Experience::query()->ordered()->get(),
            'hardSkills' => $skills->where('type', SkillType::Hard)->values(),
            'softSkills' => $skills->where('type', SkillType::Soft)->values(),
            'certificates' => Certificate::query()->ordered()->get(),
        ]);
    }

    public function contact(): View
    {
        return view('portfolio.contact', [
            'profile' => Profile::current(),
        ]);
    }
}
