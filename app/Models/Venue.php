<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;
    protected $table = 'venues';

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = ['name', 'description', 'slug', 'is_active', 'google_maps_link', 'user_id', 'municipality_id', 'type_id'];

    public function venueOpeningHours()
    {
        return $this->hasMany(VenueOpeningHour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function venueType()
    {
        return $this->belongsTo(VenueType::class, 'type_id');
    }

}
