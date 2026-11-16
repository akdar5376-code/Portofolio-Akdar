<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit', [
            'profile' => Profile::current(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $profile = Profile::current();
        $data = $request->validated();

        unset($data['avatar'], $data['cv'], $data['remove_avatar'], $data['remove_cv']);

        $oldFiles = [];
        $newFiles = [];

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('profile', 'public');

            if (! $avatarPath) {
                return back()
                    ->withErrors(['avatar' => 'Foto profil gagal disimpan. Silakan coba lagi.'])
                    ->withInput();
            }

            $data['avatar_path'] = $avatarPath;
            $newFiles[] = $avatarPath;
            $oldFiles[] = $profile->avatar_path;
        } elseif ($request->boolean('remove_avatar')) {
            $data['avatar_path'] = null;
            $oldFiles[] = $profile->avatar_path;
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('profile', 'public');

            if (! $cvPath) {
                foreach ($newFiles as $newPath) {
                    Storage::disk('public')->delete($newPath);
                }

                return back()
                    ->withErrors(['cv' => 'File CV gagal disimpan. Silakan coba lagi.'])
                    ->withInput();
            }

            $data['cv_path'] = $cvPath;
            $newFiles[] = $cvPath;
            $oldFiles[] = $profile->cv_path;
        } elseif ($request->boolean('remove_cv')) {
            $data['cv_path'] = null;
            $oldFiles[] = $profile->cv_path;
        }

        $profile->update($data);

        foreach ($oldFiles as $path) {
            $this->deleteFile($path);
        }

        return back()
            ->with('status', 'Informasi profil berhasil diperbarui.')
            ->with('status_title', 'Profil Diperbarui');
    }

    private function deleteFile(?string $path): void
    {
        if (filled($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
