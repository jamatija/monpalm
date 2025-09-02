<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'description', 'slug', 'is_active', 'google_maps_link', 'user_id', 'municipality_id', 'type_id'];

    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
    }

}
