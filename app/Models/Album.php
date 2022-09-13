<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'annee',
        'img',
        'descImg'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'annee' => 'date',
    ];

    public function versionMorceaus()
    {
        return $this->belongsToMany(VersionMorceau::class, 'appartient_albums')
        ->withPivot(['id','numero_piste']);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_albums');
    }

    public function produit()
    {
        return $this->belongsToMany(Groupe::class, 'produits');
    }
}
