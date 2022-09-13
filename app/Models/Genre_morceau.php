<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_morceau extends Model
{
    protected $fillable = [
        'genre_id',
        'version_morceau_id'
    ];

    public $timestamps = false;
}
