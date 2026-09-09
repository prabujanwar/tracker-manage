<?php

namespace App\Http\Requests\LifeArea;

class UpdateLifeAreaRequest extends StoreLifeAreaRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'min:2', 'max:80'],
            'color' => ['nullable', 'string', 'max:20'],
            'icon' => ['nullable', 'string', 'max:40'],
        ];
    }
}
