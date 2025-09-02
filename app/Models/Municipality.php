<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasSlug;


class Municipality extends Model
{
    /** @use HasFactory<\Database\Factories\MunicipalityFactory> */
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'slug'];

}
