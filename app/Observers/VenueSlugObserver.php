<?php

namespace App\Observers;

use App\Models\Venue;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VenueSlugObserver
{
    /**
     * Handle the Venue "created" event.
     */
    public function created(Venue $venue): void
    {
        //
    }

    public function creating(Venue $venue):void
    {
        $this->createUniqueSlug($venue);
    }

    /**
     * Handle the Venue "updated" event.
     */
    public function updated(Venue $venue): void
    {
        //
    }

    public function updating(Venue $venue): void
    { 
        $this->createUniqueSlug($venue);
    }

    /**
     * Handle the Venue "deleted" event.
     */
    public function deleted(Venue $venue): void
    {
        //
    }

    /**
     * Handle the Venue "restored" event.
     */
    public function restored(Venue $venue): void
    {
        //
    }

    /**
     * Handle the Venue "force deleted" event.
     */
    public function forceDeleted(Venue $venue): void
    {
        //
    }


    public function createUniqueSlug($venue){
        
        if (!$venue->isDirty('name') && !$venue->isDirty('municipality_id')) {
            return;
        }

        $base = Str::slug($venue->name); 
        $munSlug = Municipality::whereKey($venue->municipality_id)->value('slug');
        $slug = $munSlug ? "{$base}-{$munSlug}" : $base;

        $original = $slug;
        $i = 2;
        while (
            Venue::where('slug', $slug)
                ->when($venue->id, fn($q) => $q->where('id', '!=', $venue->id))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        $venue->slug = $slug;
    }
}
