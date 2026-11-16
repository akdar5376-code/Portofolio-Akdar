<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificateRequest;
use App\Models\Certificate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $certificates = Certificate::query()->ordered()->get();

        return view('admin.certificates.index', [
            'certificates' => $certificates,
            'editing' => $request->integer('edit') !== 0
                ? $certificates->firstWhere('id', $request->integer('edit'))
                : null,
        ]);
    }

    public function store(StoreCertificateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('certificates', 'public');
        }

        $data['sort_order'] = (int) Certificate::query()->max('sort_order') + 1;

        Certificate::query()->create($data);

        return back()
            ->with('status', 'Sertifikat berhasil ditambahkan.')
            ->with('status_title', 'Sertifikat Ditambahkan');
    }

    public function update(StoreCertificateRequest $request, Certificate $certificate): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image']);

        if ($request->hasFile('image')) {
            $this->deleteImage($certificate);
            $data['image_path'] = $request->file('image')->store('certificates', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($certificate);
            $data['image_path'] = null;
        }

        $certificate->update($data);

        return back()
            ->with('status', "{$certificate->title} berhasil diperbarui.")
            ->with('status_title', 'Sertifikat Diperbarui');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $this->deleteImage($certificate);
        $certificate->delete();

        return back()
            ->with('status', "{$certificate->title} telah dihapus.")
            ->with('status_title', 'Sertifikat Dihapus');
    }

    private function deleteImage(Certificate $certificate): void
    {
        if (filled($certificate->image_path)) {
            Storage::disk('public')->delete($certificate->image_path);
        }
    }
}
