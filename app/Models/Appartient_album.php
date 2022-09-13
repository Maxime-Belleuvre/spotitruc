<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartient_album extends Model
{
    protected $fillable = [
        'album_id',
        'version_morceau_id',
        'numero_piste'
    ];

    public $timestamps = false;
    use HasFactory;
}
