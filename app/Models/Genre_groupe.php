<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_groupe extends Model
{
    protected $fillable = [
        'groupe_id',
        'genre_id'
    ];

    public $timestamps = false;
    use HasFactory;

    public function groupe(){
        return $this->hasOne(Artiste::class,'id','groupe_id');
    }
    public function genre(){
        return $this->hasOne(Genre::class,'id','genre_id');
    }
}
