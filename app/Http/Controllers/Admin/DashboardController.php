<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'projects' => Project::query()->count(),
                'certificates' => Certificate::query()->count(),
                'skills' => Skill::query()->count(),
                'experiences' => Experience::query()->count(),
                'unreadMessages' => Message::query()->unread()->count(),
            ],
            'recentProjects' => Project::query()->latest()->take(4)->get(),
            'latestMessages' => Message::query()->latest()->take(4)->get(),
        ]);
    }
}
