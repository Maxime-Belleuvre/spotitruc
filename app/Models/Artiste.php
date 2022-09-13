<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'date_deces',
        'nationalite',
        'pseudo',
        'img',
        'descImg',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_artistes');
    }

   

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'membre')
        ->withPivot(['id','date_debut','date_fin']);
    }

    

    public function versionMorceaus()
    {
        return $this->belongsToMany(VersionMorceau::class, 'intervient_morceaus')
        ->withPivot(['id','role']);

    }

    public function genre_artiste(){
        return $this->hasMany(Genre_artiste::class,'artiste_id','id');
    }
}
