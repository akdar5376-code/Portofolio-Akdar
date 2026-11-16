<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.posts.index', [
            'posts' => $posts,
            'counts' => [
                'total' => $posts->count(),
                'published' => $posts->where('is_published', true)->count(),
                'drafts' => $posts->where('is_published', false)->count(),
            ],
            'editing' => $request->integer('edit') !== 0
                ? $posts->firstWhere('id', $request->integer('edit'))
                : null,
        ]);
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['cover']);

        $data['category'] = PostCategory::tryFrom((string) ($data['category'] ?? '')) ?? PostCategory::Artikel;
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $this->resolvePublishedAt($data, null);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('posts', 'public');
        }

        Post::query()->create($data);

        return back()
            ->with('status', 'Artikel berhasil disimpan ke blog.')
            ->with('status_title', $data['is_published'] ? 'Artikel Diterbitkan' : 'Draf Disimpan');
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        unset($data['cover'], $data['remove_cover']);

        $data['category'] = PostCategory::tryFrom((string) ($data['category'] ?? '')) ?? $post->category;
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $this->resolvePublishedAt($data, $post);

        if ($request->hasFile('cover')) {
            $this->deleteCover($post);
            $data['cover_path'] = $request->file('cover')->store('posts', 'public');
        } elseif ($request->boolean('remove_cover')) {
            $this->deleteCover($post);
            $data['cover_path'] = null;
        }

        $post->update($data);

        return back()
            ->with('status', "{$post->title} berhasil diperbarui.")
            ->with('status_title', 'Artikel Diperbarui');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->deleteCover($post);
        $post->delete();

        return back()
            ->with('status', "{$post->title} telah dihapus dari blog.")
            ->with('status_title', 'Artikel Dihapus');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolvePublishedAt(array $data, ?Post $post): ?string
    {
        if (filled($data['published_at'] ?? null)) {
            return (string) $data['published_at'];
        }

        if (! ($data['is_published'] ?? false)) {
            return null;
        }

        return $post?->published_at?->toDateTimeString() ?? now()->toDateTimeString();
    }

    private function deleteCover(Post $post): void
    {
        if (filled($post->cover_path)) {
            Storage::disk('public')->delete($post->cover_path);
        }
    }
}
