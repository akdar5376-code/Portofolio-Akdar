<?php

namespace App\Http\Requests;

class UpdatePostRequest extends StorePostRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'remove_cover' => ['sometimes', 'accepted'],
        ];
    }
}
