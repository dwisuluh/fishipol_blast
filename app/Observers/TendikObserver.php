<?php

namespace App\Observers;

use App\Models\Tendik;

class TendikObserver
{
    /**
     * Handle the Tendik "created" event.
     */
    public function created(Tendik $tendik): void
    {
        //
    }

    /**
     * Handle the Tendik "updated" event.
     */
    public function updated(Tendik $tendik): void
    {
        $kontak = $tendik->kontak;

        if($kontak){
            $kontak->no_hp = $tendik->no_hp;
            $kontak->save();
        }
    }

    /**
     * Handle the Tendik "deleted" event.
     */
    public function deleted(Tendik $tendik): void
    {
        //
    }

    /**
     * Handle the Tendik "restored" event.
     */
    public function restored(Tendik $tendik): void
    {
        //
    }

    /**
     * Handle the Tendik "force deleted" event.
     */
    public function forceDeleted(Tendik $tendik): void
    {
        //
    }
}
