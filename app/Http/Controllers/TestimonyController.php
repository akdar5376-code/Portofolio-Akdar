<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonyRequest;
use App\Models\Testimony;
use Illuminate\Http\RedirectResponse;

class TestimonyController extends Controller
{
    public function store(StoreTestimonyRequest $request): RedirectResponse
    {
        Testimony::query()->create([
            ...$request->validated(),
            'is_visible' => true,
        ]);

        return back()
            ->with('status', 'Terima kasih! Testimoni kamu sudah dikirim.')
            ->with('status_title', 'Testimoni Terkirim');
    }
}
