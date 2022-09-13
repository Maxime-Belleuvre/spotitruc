<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre_album extends Model
{
    protected $fillable = [
        'album_id',
        'genre_id'
    ];

    public $timestamps = false;
    use HasFactory;

    public function album(){
        return $this->hasOne(Album::class,'id','album_id');
    }
    public function genre(){
        return $this->hasOne(Genre::class,'id','genre_id');
    }
}
