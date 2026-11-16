<?php

namespace App\Http\Requests;

use App\Enums\TestimonyRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTestimonyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'role' => ['required', Rule::enum(TestimonyRole::class)],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }
}
