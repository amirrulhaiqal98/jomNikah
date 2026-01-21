<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeddingRequest extends FormRequest
{
    /**
     * AC: 2 - Authorize: Only super-admin can create wedding accounts
     */
    public function authorize(): bool
    {
        return auth()->user()?->can('create_wedding_accounts') ?? false;
    }

    /**
     * AC: 3, 4 - Validate rules: Required fields, unique email, phone validation
     */
    public function rules(): array
    {
        return [
            'bride_name' => ['required', 'string', 'max:255'],
            'groom_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'], // AC: 4 - Unique check
            'phone' => ['required', 'string', 'min:10', 'max:15', 'regex:/^[0-9+\-\s]+$/'], // Malaysian phone format
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Optional - if provided, must be min 8 chars
        ];
    }

    /**
     * AC: 3 - Bilingual validation messages (NFR-USE-004)
     */
    public function messages(): array
    {
        return [
            'bride_name.required' => 'Maaf, nama pengantin perempuan diperlukan. / Sorry, bride name is required.',
            'groom_name.required' => 'Maaf, nama pengantin lelaki diperlukan. / Sorry, groom name is required.',
            'email.required' => 'Maaf, emel diperlukan. / Sorry, email is required.',
            'email.email' => 'Maaf, format emel tidak sah. / Sorry, email format is invalid.',
            'email.unique' => 'Maaf, emel ini sudah didaftarkan. / Sorry, this email is already registered.',
            'phone.required' => 'Maaf, nombor telefon diperlukan. / Sorry, phone number is required.',
            'phone.regex' => 'Maaf, format nombor telefon tidak sah. / Sorry, phone format is invalid.',
            'phone.min' => 'Maaf, nombor telefon mesti sekurang-kurangnya 10 digit. / Sorry, phone number must be at least 10 digits.',
            'password.min' => 'Maaf, kata laluan mesti sekurang-kurangnya 8 aksara. / Sorry, password must be at least 8 characters.',
            'password.confirmed' => 'Maaf, pengesahan kata laluan tidak sepadan. / Sorry, password confirmation does not match.',
        ];
    }
}
