<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $projects = Project::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.projects.index', [
            'projects' => $projects,
            'counts' => [
                'total' => $projects->count(),
                'featured' => $projects->where('is_featured', true)->count(),
            ],
            'editing' => $request->integer('edit') !== 0
                ? $projects->firstWhere('id', $request->integer('edit'))
                : null,
        ]);
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['thumbnail']);

        $data['category'] = trim((string) ($data['category'] ?? '')) ?: null;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = (int) Project::query()->max('sort_order') + 1;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::query()->create($data);

        return back()
            ->with('status', 'Proyek berhasil diterbitkan ke galeri publik.')
            ->with('status_title', 'Proyek Diterbitkan');
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        unset($data['thumbnail'], $data['remove_thumbnail']);

        $data['category'] = trim((string) ($data['category'] ?? '')) ?: null;
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $this->deleteThumbnail($project);
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        } elseif ($request->boolean('remove_thumbnail')) {
            $this->deleteThumbnail($project);
            $data['thumbnail_path'] = null;
        }

        $project->update($data);

        return back()
            ->with('status', "{$project->title} berhasil diperbarui.")
            ->with('status_title', 'Proyek Diperbarui');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteThumbnail($project);
        $project->delete();

        return back()
            ->with('status', "{$project->title} telah dihapus dari galeri.")
            ->with('status_title', 'Proyek Dihapus');
    }

    private function deleteThumbnail(Project $project): void
    {
        if (filled($project->thumbnail_path)) {
            Storage::disk('public')->delete($project->thumbnail_path);
        }
    }
}
