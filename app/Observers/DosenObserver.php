<?php

namespace App\Observers;

use App\Models\Dosen;

class DosenObserver
{
    /**
     * Handle the Dosen "created" event.
     */
    public function created(Dosen $dosen): void
    {
        //
    }

    /**
     * Handle the Dosen "updated" event.
     */
    public function updated(Dosen $dosen): void
    {
        //
    }

    /**
     * Handle the Dosen "deleted" event.
     */
    public function deleted(Dosen $dosen): void
    {
        //
    }

    /**
     * Handle the Dosen "restored" event.
     */
    public function restored(Dosen $dosen): void
    {
        //
    }

    /**
     * Handle the Dosen "force deleted" event.
     */
    public function forceDeleted(Dosen $dosen): void
    {
        //
    }
}
