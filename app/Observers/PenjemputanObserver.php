<?php

namespace App\Observers;

use App\Models\Penjemputan;
use Illuminate\Support\Facades\File;

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
        $file = public_path(str_replace(env('APP_URL'),'',$penjemputan->screenshoot));
        if (file_exists($file)) { //(File::exists($file)) {
            unlink($file); //File::delete($file);
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
