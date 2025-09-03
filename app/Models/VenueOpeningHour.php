<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenueOpeningHour extends Model
{
    protected $table = 'venue_opening_hours';
    protected $fillable = [
        'venue_id',
        'day_of_week',
        'open_time',
        'close_time',
        'notes',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
