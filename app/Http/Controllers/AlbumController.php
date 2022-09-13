<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumStoreRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Groupe;
use App\Models\Genre;
use App\Models\Genre_album;
use App\Models\Produit;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albums = Album::all();

        return view('album.index', compact('albums'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres = Genre::all();
        $groupes = Groupe::all();
        return view('album.create', compact('genres', 'groupes'));
    }

    /**
     * @param \App\Http\Requests\AlbumStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumStoreRequest $request)
    {

        $file = $request->file('img');
        $path = $file->storeAs('avatarAlbum', $file->getFilename(), ['disk' => 'public']);
        Album::create(
            [
                "titre" => $request->titre,
                "annee" => $request->annee,
                'img' => $path,
                "descImg" => $request->descImg
            ]   
        );

        $album = Album::where(
            ['titre' => $request->titre]
        )->first();

        
        Genre_album::create(
            [
                'album_id' => $album->id,
                "genre_id" => $request->genre,
            ]
        );

        Produit::create(
            [
                "album_id" => $album->id,
                "groupe_id" => $request->groupe
            ]
        );

        return redirect()->route('album.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Album $album)
    {
        return view('album.show', compact('album'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Album $album)
    {
        $groupes = Groupe::all();
        return view('album.edit', compact('album','groupes'));
    }

    /**
     * @param \App\Http\Requests\AlbumUpdateRequest $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        if($request->img == null){

                $album->titre = $request->titre;
                $album->annee = $request->annee;
                $album->descImg = $request->descImg;

                $album->save();
        
        }else{
            $before = $album->img;
        
            unlink(storage_path('app/public/'.$before));
            $file = $request->file('img');
            $path = $file->storeAs('avatarAlbum', $file->getFilename(), ['disk' => 'public']);
            $album->img = $path;
            $album->save();
        }

        return redirect()->route('album.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Album $album)
    {
        $album->delete();

        return redirect()->route('album.index');
    }
}
