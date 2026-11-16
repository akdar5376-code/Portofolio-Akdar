<?php

namespace App\Http\Controllers;

use App\Enums\PostCategory;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $category = PostCategory::tryFrom((string) $request->query('category'));
        $search = trim((string) $request->query('q'));

        $posts = Post::query()
            ->published()
            ->ofCategory($category)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('tags', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('portfolio.blog.index', [
            'profile' => Profile::current(),
            'posts' => $posts,
            'activeCategory' => $category,
            'search' => $search,
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->isVisible(), 404);

        $related = Post::query()
            ->published()
            ->whereKeyNot($post->getKey())
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(6)
            ->get()
            ->sortByDesc(fn (Post $related): bool => $related->category === $post->category)
            ->take(3)
            ->values();

        return view('portfolio.blog.show', [
            'profile' => Profile::current(),
            'post' => $post,
            'related' => $related,
        ]);
    }
}
