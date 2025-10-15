<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/@mit\.edu$/',  // allow only mit.edu emails
                Rule::unique('users')
                    ->ignore(Auth::id())
                    ->whereNull('deleted_at'),  // allow reusing soft-deleted user's email
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^()\-_=+{}\[\]|\:;"\'<>,.\/?]).{8,}$/',
            ],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }
}
