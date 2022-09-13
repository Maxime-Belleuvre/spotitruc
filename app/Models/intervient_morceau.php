<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervient_morceau extends Model
{
    protected $fillable = [
        'artiste_id',
        'version_morceau_id',
        'role'
    ];

    public $timestamps = false;
}
