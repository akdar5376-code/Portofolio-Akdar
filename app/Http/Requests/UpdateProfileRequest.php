<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'role' => ['nullable', 'string', 'max:150'],
            'class_name' => ['nullable', 'string', 'max:100'],
            'competency' => ['nullable', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:200'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'email' => ['nullable', 'email', 'max:150'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'instagram_url' => ['nullable', 'url', 'max:2048'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'career_goal' => ['nullable', 'string', 'max:5000'],
            'interests' => ['nullable', 'string', 'max:2000'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:8192'],
            'remove_avatar' => ['sometimes', 'accepted'],
            'remove_cv' => ['sometimes', 'accepted'],
        ];
    }
}
