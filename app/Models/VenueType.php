<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasSlug;

class VenueType extends Model
{
    /** @use HasFactory<\Database\Factories\VenueTypeFactory> */
    use HasFactory;
    use HasSlug;

    protected $table = 'venue_types';

    protected $fillable = ['name', 'slug'];

}
