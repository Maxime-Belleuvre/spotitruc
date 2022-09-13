<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupeStoreRequest;
use App\Http\Requests\GroupeUpdateRequest;
use App\Models\Groupe;
use App\Models\Genre;
use App\Models\Genre_groupe;
use App\Models\Membre;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groupes = Groupe::all();
        $membres = Membre::all();
        $genre_groupes = Genre_groupe::all();

        return view('groupe.index', compact('groupes','membres','genre_groupes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres = Genre::all();
        $artistes = Artiste::all();
        return view('groupe.create', compact('genres', 'artistes'));
    }

    /**
     * @param \App\Http\Requests\GroupeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupeStoreRequest $request)
    {
        $file = $request->file('img');        
        $path = $file->storeAs('avatarGroupe', $file->getFilename(), ['disk' => 'public']);
        Groupe::create(
            [
                'nom' => $request->nom,
                'nationalite' => $request->nationalite,
                'date_creation' => $request->date_creation,
                'date_destruction' => $request->date_destruction,
                "img" => $path,
                "descImg" => $request->descImg
            ]
        );
        
        

        $groupe = Groupe::where(
            ['nom' => $request->nom]
        )->first();

        Membre::create(
            [
                'date_depart' => $request->date_depart,
                'date_fin'=> $request->date_fin,
                'groupe_id' => $groupe->id,
                'artiste_id'=> $request->artiste
            ]
        );
        Genre_groupe::create(
            [
                'groupe_id'=> $groupe->id,
                'genre_id' => $request->genre
            ]
        );

        return redirect()->route('groupe.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Groupe $groupe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Groupe $groupe)
    {
        $genres_groupes = Genre_groupe::where(
            ['groupe_id' => $groupe->id]
        )->get();

        $genres = DB::table('genres')
            ->select('id','genre')
            ->whereNotIn('id',DB::table('genre_groupes')
                            ->select('genre_id')
                            ->where('genre_groupes.groupe_id', '=', $groupe->id))
            ->get();
        return view('groupe.show', compact('groupe','genres_groupes','genres'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Groupe $groupe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Groupe $groupe)
    {
        return view('groupe.edit', compact('groupe'));
    }

    /**
     * @param \App\Http\Requests\GroupeUpdateRequest $request
     * @param \App\Models\Groupe $groupe
     * @return \Illuminate\Http\Response
     */
    public function update(GroupeUpdateRequest $request, Groupe $groupe)
    {
        if($request->img == null){
            
                $groupe->nom = $request->nom;
                $groupe->nationalite = $request->nationalite;
                $groupe->date_creation = $request->date_creation;
                $groupe->date_destruction = $request->date_destruction;
                $groupe->descImg = $request->descImg;

                $groupe->save();
            
       
        }
        else{
            
            $before = $groupe->img;
        
            unlink(storage_path('app/public/'.$before));
            $file = $request->file('img');
            $path = $file->storeAs('avatarGroupe', $file->getFilename(), ['disk' => 'public']);
            $groupe->img = $path;

            $groupe->save();
        }

        return redirect()->route('groupe.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Groupe $groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Groupe $groupe)
    {
        $groupe->delete();

        return redirect()->route('groupe.index');
    }
}
