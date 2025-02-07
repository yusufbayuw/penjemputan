<?php

namespace App\Observers;

use App\Models\Penjemputan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PenjemputanObserver
{
    /**
     * Handle the Penjemputan "created" event.
     */
    public function created(Penjemputan $penjemputan): void
    {
        //
    }

    /**
     * Handle the Penjemputan "updated" event.
     */
    public function updated(Penjemputan $penjemputan): void
    {
        //
    }

    /**
     * Handle the Penjemputan "deleted" event.
     */
    public function deleted(Penjemputan $penjemputan): void
    {
        $path = $penjemputan->screenshoot;
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Handle the Penjemputan "restored" event.
     */
    public function restored(Penjemputan $penjemputan): void
    {
        //
    }

    /**
     * Handle the Penjemputan "force deleted" event.
     */
    public function forceDeleted(Penjemputan $penjemputan): void
    {
        //
    }
}
