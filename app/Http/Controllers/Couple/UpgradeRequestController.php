<?php

namespace App\Http\Controllers\Couple;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use App\Notifications\PackageUpgradeRequest;
use Illuminate\Support\Facades\Auth;

class UpgradeRequestController extends Controller
{
    /**
     * Store a newly created upgrade request in storage.
     * AC: 4 - Only authenticated couples can request upgrade
     */
    public function store()
    {
        // Authorization: Ensure user is a couple (defense in depth)
        if (!Auth::user()?->hasRole('couple')) {
            abort(403, 'Maaf, hanya pasangan yang boleh meminta naik taraf. / Sorry, only couples can request upgrade.');
        }

        $wedding = Auth::user()->wedding;

        // Notify all super-admins
        $superAdmins = \App\Models\User::role('super-admin')->get();
        foreach ($superAdmins as $admin) {
            $admin->notify(new PackageUpgradeRequest($wedding));
        }

        return back()->with('success', 'Upgrade request sent! We will contact you soon. / Permintaan naik taraf telah dihantar! Kami akan menghubungi anda tidak lama lagi.');
    }
}
