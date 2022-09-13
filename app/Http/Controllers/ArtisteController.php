<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtisteStoreRequest;
use App\Http\Requests\ArtisteUpdateRequest;
use App\Http\Requests\Genre_artisteStoreRequest;
use App\Models\Artiste;
use App\Models\Genre;
use App\Models\Genre_artiste;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArtisteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $artistes = Artiste::all();

        return view('artiste.index', compact('artistes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres = Genre::all();
        return view('artiste.create', compact('genres'));
    }

    /**
     * @param \App\Http\Requests\ArtisteStoreRequest $request
     * @param \App\Http\Requests\Genre_artisteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtisteStoreRequest $request)
    {
        
        $file = $request->file('img');
        
        
        $path = $file->storeAs('avatarArtiste', $file->getFilename(), ['disk' => 'public']);
        Artiste::create(
            [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'date_deces' => $request->date_deces,
                'nationalite' => $request->nationalite,
                'pseudo' => $request->pseudo,
                "img" => $path,
                "descImg" => $request->descImg
            ]
        );
        
        $artiste = Artiste::where(
            ['pseudo' => $request->pseudo]
        )->first();

        
        Genre_artiste::create(
            [
                'artiste_id'=> $artiste->id,
                'genre_id' => $request->genre
            ]
        );

        return redirect()->route('artiste.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Artiste $artiste
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Artiste $artiste)
    {
        //$genres = Genre::all();

        
        /*$id_artiste = $artiste->id;
        $queryGenre = Genre_artiste::with('artiste')->whereHas('artiste',function($query){
            $query->where('artiste_id','=', $id_artiste);
        })->get();*/

        
        $genres_artistes = Genre_artiste::where(
            ['artiste_id' => $artiste->id]
        )->get();
        

        /*$genres = DB::table('genres')
            ->join('genre_artistes', 'genres.id', '=', 'genre_artistes.genre_id')
            ->whereNotIn('genre_artistes')
            ->where('genre_artistes.artiste_id', '!=', $artiste->id)
            ->select('genres.id','genres.genre')
            ->get();*/

        $genres = DB::table('genres')
            ->select('id','genre')
            ->whereNotIn('id',DB::table('genre_artistes')->select('genre_id')->where('genre_artistes.artiste_id', '=', $artiste->id))
            ->get();

        /*$genres = DB::table('genre_artistes')->select('*')->where('genre_artistes.artiste_id', '=', $artiste->id)
        ->get();*/
        
        return view('artiste.show', compact('artiste','genres','genres_artistes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Artiste $artiste
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Artiste $artiste)
    {
        return view('artiste.edit', compact('artiste'));
    }

    /**
     * @param \App\Http\Requests\ArtisteUpdateRequest $request
     * @param \App\Models\Artiste $artiste
     * @return \Illuminate\Http\Response
     */
    public function update(ArtisteUpdateRequest $request, Artiste $artiste)
    {
        
        if($request->img == NULL){
            $artiste->nom = $request->nom;
            $artiste->prenom = $request->prenom;
            $artiste->date_naissance = $request->date_naissance;
            $artiste->date_deces = $request->date_deces;
            $artiste->nationalite = $request->nationalite;
            $artiste->pseudo = $request->pseudo;
            $artiste->descImg = $request->descImg;

            $artiste->save();
        }else{

            $before = $artiste->img;
            unlink(storage_path('app/public/'.$before));
            $file = $request->file('img');
            $path = $file->storeAs('avatarArtiste', $file->getFilename(), ['disk' => 'public']);

            $artiste->img = $path;
            $artiste->save();
        }
        

        return redirect()->route('artiste.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Artiste $artiste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Artiste $artiste)
    {
        $artiste->delete();

        return redirect()->route('artiste.index');
    }
}
