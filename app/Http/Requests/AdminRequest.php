<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Admin;

class AdminRequest extends FormRequest
{
    
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new Admin)->getTable())->ignore($this->route()->admin->id ?? null)
            ],
            'password' => [
                $this->route()->admin ? 'nullable' : 'required', 'confirmed', 'min:6'
            ]
        ];
    }
}
