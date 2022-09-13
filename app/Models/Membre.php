<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_depart',
        'date_fin',
        'groupe_id',
        'artiste_id'
    ];

    public $timestamps = false;
}
