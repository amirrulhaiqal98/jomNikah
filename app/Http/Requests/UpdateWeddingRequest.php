<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeddingRequest extends FormRequest
{
    /**
     * AC: 2 - Authorize: Only super-admin can update wedding accounts
     * FIXED: Use permission check for consistency with StoreWeddingRequest
     */
    public function authorize(): bool
    {
        return auth()->user()?->can('manage_weddings') ?? false;
    }

    /**
     * AC: 3, 4 - Validate rules for update (Story 1.4)
     * FIXED: Explicitly prohibit package_tier and email changes (admin-only operations)
     */
    public function rules(): array
    {
        return [
            'bride_name' => ['required', 'string', 'max:255'],
            'groom_name' => ['required', 'string', 'max:255'],
            'wish_present_enabled' => ['nullable', 'boolean'], // Story 1.4 - Feature toggle
            'digital_ang_pow_enabled' => ['nullable', 'boolean'], // Story 1.4 - Feature toggle
            'package_tier' => ['prohibited'], // FIXED: Prevent tier changes via edit (use dedicated upgrade workflow)
            'email' => ['prohibited'], // FIXED: Email changes require separate admin workflow
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
            'wish_present_enabled.boolean' => 'Maaf, nilai pilihan tidak sah. / Sorry, selection value is invalid.',
            'digital_ang_pow_enabled.boolean' => 'Maaf, nilai pilihan tidak sah. / Sorry, selection value is invalid.',
            'package_tier.prohibited' => 'Maaf, pakej tidak boleh diubah di sini. / Sorry, package tier cannot be changed here.',
            'email.prohibited' => 'Maaf, emel tidak boleh diubah. / Sorry, email cannot be changed.',
        ];
    }
}
