<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:300'],
            'detail' => ['nullable', 'string', 'max:5000'],
            'problem' => ['nullable', 'string', 'max:2000'],
            'goal' => ['nullable', 'string', 'max:2000'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'role' => ['nullable', 'string', 'max:150'],
            'features' => ['nullable', 'string', 'max:5000'],
            'process' => ['nullable', 'string', 'max:5000'],
            'user_feedback' => ['nullable', 'string', 'max:2000'],
            'project_url' => ['nullable', 'url', 'max:2048'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_featured' => ['sometimes', 'boolean'],
        ];
    }
}
