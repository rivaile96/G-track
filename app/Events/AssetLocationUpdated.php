<?php

namespace App\Events;

use App\Models\Asset;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssetLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Data aset yang akan dikirim bersama event.
     * Dibuat 'public' agar bisa diakses oleh pendengar.
     */
    public Asset $asset;

    /**
     * Create a new event instance.
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * Channel tempat event ini akan disiarkan.
     * Frontend kita akan mendengarkan di channel 'map-updates'.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('map-updates'),
        ];
    }
}