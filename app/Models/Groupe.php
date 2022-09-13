<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'nationalite',
        'date_creation',
        'date_destruction',
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
        'date_creation' => 'date',
        'date_destruction' => 'date',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_groupes');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'etiquette_groupe');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'etiquette_groupe');
    }

    public function artistes()
    {
        return $this->belongsToMany(Artiste::class, 'membres')
        ->withPivot(['id','date_depart','date_fin']);
    }
}
