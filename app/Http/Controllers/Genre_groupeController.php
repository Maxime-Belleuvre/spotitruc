<?php

namespace App\Http\Controllers;

use App\Models\Genre_groupe;
use Illuminate\Http\Request;

class Genre_groupeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Genre_groupe::create(
            [
                'groupe_id'=> $request->groupe_id,
                'genre_id' => $request->genre_id
            ]
        );
        return redirect('groupe/'.$request->groupe_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre_groupe  $genre_groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre_groupe $genre_groupe)
    {
        
        $genre_groupe ->delete();
        return redirect('groupe/'.$genre_groupe->groupe_id);
    }
}
