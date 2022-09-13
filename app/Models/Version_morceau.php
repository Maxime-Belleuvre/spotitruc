<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version_morceau extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'duree_secondes',
        'filepath',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function morceaus()
    {
        return $this->belongsToMany(Morceau::class, 'orchestration');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'appartient_albums')
        ->withPivot(['id','numero_piste']);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_morceaus');
    }

    public function artistes()
    {
        return $this->belongsToMany(Artiste::class, 'intervient_morceaus')
        ->withPivot(['id','role']);;
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'contient_morceau')
        ->withPivot(['id','position']);
    }
}
