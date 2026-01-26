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
     * AC: 3, 4 - Validate rules for update (Story 1.4, modified for Story 1.5)
     * Story 1.5: Allow package_tier changes for upgrade/downgrade
     */
    public function rules(): array
    {
        return [
            'bride_name' => ['required', 'string', 'max:255'],
            'groom_name' => ['required', 'string', 'max:255'],
            'package_tier' => ['nullable', 'in:standard,premium'], // Story 1.5 - ALLOW package tier changes
            'wish_present_enabled' => ['nullable', 'boolean'], // Story 1.4 - Feature toggle
            'digital_ang_pow_enabled' => ['nullable', 'boolean'], // Story 1.4 - Feature toggle
            'email' => ['prohibited'], // Still cannot change email
        ];
    }

    /**
     * AC: 3 - Bilingual validation messages (NFR-USE-004)
     * Story 1.5: Added package tier validation message
     */
    public function messages(): array
    {
        return [
            'bride_name.required' => 'Maaf, nama pengantin perempuan diperlukan. / Sorry, bride name is required.',
            'groom_name.required' => 'Maaf, nama pengantin lelaki diperlukan. / Sorry, groom name is required.',
            'package_tier.in' => 'Maaf, pakej tidak sah. / Sorry, invalid package tier.',
            'wish_present_enabled.boolean' => 'Maaf, nilai pilihan tidak sah. / Sorry, selection value is invalid.',
            'digital_ang_pow_enabled.boolean' => 'Maaf, nilai pilihan tidak sah. / Sorry, selection value is invalid.',
            'email.prohibited' => 'Maaf, emel tidak boleh diubah. / Sorry, email cannot be changed.',
        ];
    }
}
