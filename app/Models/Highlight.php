<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Venue;


class Highlight extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','category'];

    public function venues()
    {
        return $this->belongsToMany(Venue::class)
            ->withPivot('is_primary');
    }
}
