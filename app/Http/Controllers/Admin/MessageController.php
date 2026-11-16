<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => Message::query()->latest()->get(),
            'unreadCount' => Message::query()->unread()->count(),
        ]);
    }

    public function toggleRead(Message $message): RedirectResponse
    {
        $message->update(['is_read' => ! $message->is_read]);

        return back()->with('status', 'Status pesan berhasil diubah.')
            ->with('status_title', 'Pesan Diperbarui');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return back()
            ->with('status', 'Pesan telah dihapus.')
            ->with('status_title', 'Pesan Dihapus');
    }
}
