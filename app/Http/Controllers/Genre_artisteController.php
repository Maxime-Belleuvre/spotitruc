<?php

namespace App\Http\Controllers;

use App\Models\Genre_artiste;
use Illuminate\Http\Request;

class Genre_artisteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Genre_artiste::create(
            [
                'artiste_id'=> $request->artiste_id,
                'genre_id' => $request->genre_id
            ]
        );
        return redirect('artiste/'.$request->artiste_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre_artiste  $genre_artiste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre_artiste $genre_artiste)
    {
        
        $genre_artiste ->delete();
        return redirect('artiste/'.$genre_artiste->artiste_id);
    }
}
