<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request): RedirectResponse
    {
        Message::query()->create($request->validated());

        return redirect()->route('home')
            ->with('status', 'Terima kasih! Pesan dan kesan kamu sudah terkirim.')
            ->with('status_title', 'Pesan Terkirim');
    }
}
