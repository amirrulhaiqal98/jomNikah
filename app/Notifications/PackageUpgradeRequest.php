<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class PackageUpgradeRequest extends Notification
{

    protected $wedding;

    /**
     * Create a new notification instance.
     */
    public function __construct($wedding)
    {
        $this->wedding = $wedding;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Store in database for admin to view
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        // Determine requested package (if current is standard, they want premium)
        $requestedPackage = $this->wedding->package_tier === 'standard' ? 'premium' : 'premium';

        return [
            'wedding_id' => $this->wedding->id,
            'couple_names' => "{$this->wedding->bride_name} & {$this->wedding->groom_name}",
            'current_package' => $this->wedding->package_tier,
            'requested_package' => $requestedPackage,
            'upgrade_cost' => 'RM10',
            'url' => route('admin.weddings.edit', $this->wedding->id),
        ];
    }
}
