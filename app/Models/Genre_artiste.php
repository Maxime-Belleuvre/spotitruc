<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_artiste extends Model
{
    protected $fillable = [
        'artiste_id',
        'genre_id'
    ];

    public $timestamps = false;
    use HasFactory;

    public function artiste(){
        return $this->hasOne(Artiste::class,'id','artiste_id');
    }
    public function genre(){
        return $this->hasOne(Genre::class,'id','genre_id');
    }
}
