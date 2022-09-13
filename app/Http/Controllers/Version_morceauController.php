<?php

namespace App\Http\Controllers;

use App\Http\Requests\Version_morceauStoreRequest;
use App\Http\Requests\Version_morceauUpdateRequest;
use App\Models\Version_morceau;
use App\Models\Genre;
use App\Models\Artiste;
use App\Models\Album;
use App\Models\Genre_morceau;
use App\Models\Intervient_morceau;
use App\Models\Appartient_album;
use wapmorgan\Mp3Info\Mp3Info;
use Illuminate\Http\Request;

class Version_morceauController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $morceaux = Version_morceau::paginate(10);

        return view('versionMorceau.index', compact('morceaux'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres = Genre::all();
        $albums = Album::all();
        $artistes = Artiste::all();
        return view('versionMorceau.create', compact('genres', 'albums', 'artistes'));
    }

    /**
     * @param \App\Http\Requests\Version_morceauStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Version_morceauStoreRequest $request)
    {
        
        $fileMusique = $request->file('filepath');
        
        $audio = new Mp3Info($fileMusique, true);
        $duree = $audio->duration;
        
        $pathMusique = $fileMusique->storeAs('musicMorceau', $fileMusique->getFilename(), ['disk' => 'public']);

        Version_morceau::create(
            [
                "titre"=>$request->titre,
                "duree_secondes"=>$duree,
                "filepath"=>$pathMusique
            ]
        );

        $morceau = Version_morceau::where(
            ['titre' => $request->titre]
        )->first();

        Appartient_album::create(
            [
                'album_id' => $request->album,
                'version_morceau_id' => $morceau->id,
                'numero_piste'=> $request->numero_piste,
            ]
        );

        Intervient_morceau::create(
            [
                'artiste_id'=> $request->artiste,
                'version_morceau_id' => $morceau->id,
                'role'=>$request->role
            ]
        );

        Genre_morceau::create(
            [
                'genre_id'=>$request->genre,
                'version_morceau_id' => $morceau->id
            ]
            );
        return redirect()->route('version_morceau.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\versionMorceau $versionMorceau
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Version_morceau $versionMorceau)
    {
        return view('versionMorceau.show', compact('versionMorceau'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\versionMorceau $versionMorceau
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Version_morceau $versionMorceau)
    {
        return view('versionMorceau.edit', compact('versionMorceau'));
    }

    /**
     * @param \App\Http\Requests\Version_morceauUpdateRequest $request
     * @param \App\versionMorceau $versionMorceau
     * @return \Illuminate\Http\Response
     */
    public function update(Version_morceauUpdateRequest $request, Version_morceau $versionMorceau)
    {
        $versionMorceau->update($request->validated());

        $request->session()->flash('versionMorceau.id', $versionMorceau->id);

        return redirect()->route('versionMorceau.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\versionMorceau $versionMorceau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Version_morceau $versionMorceau)
    {
        $versionMorceau->delete();

        return redirect()->route('versionMorceau.index');
    }
}
