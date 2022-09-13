<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genres = Genre::all();

        return view('genre.index', compact('genres'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('genre.create');
    }

    /**
     * @param \App\Http\Requests\GenreStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreStoreRequest $request)
    {
        
        Genre::create(
            [
                "genre" => $request->genre
            ]
        );
        return redirect()->route('genre.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Genre $genre)
    {
        return view('genre.show', compact('genre'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Genre $genre)
    {
        return view('genre.edit', compact('genre'));
    }

    /**
     * @param \App\Http\Requests\GenreUpdateRequest $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreUpdateRequest $request, Genre $genre)
    {
        $genre->update($request->validated());

        $request->session()->flash('genre.id', $genre->id);

        return redirect()->route('genre.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genre.index');
    }
}
