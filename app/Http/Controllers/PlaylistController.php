<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistStoreRequest;
use App\Http\Requests\PlaylistUpdateRequest;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $playlists = Playlist::all();

        return view('playlist.index', compact('playlists'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('playlist.create');
    }

    /**
     * @param \App\Http\Requests\PlaylistStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaylistStoreRequest $request)
    {
        $playlist = Playlist::create($request->validated());

        $request->session()->flash('playlist.id', $playlist->id);

        return redirect()->route('playlist.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Playlist $playlist)
    {
        return view('playlist.show', compact('playlist'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Playlist $playlist)
    {
        return view('playlist.edit', compact('playlist'));
    }

    /**
     * @param \App\Http\Requests\PlaylistUpdateRequest $request
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(PlaylistUpdateRequest $request, Playlist $playlist)
    {
        $playlist->update($request->validated());

        $request->session()->flash('playlist.id', $playlist->id);

        return redirect()->route('playlist.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Playlist $playlist)
    {
        $playlist->delete();

        return redirect()->route('playlist.index');
    }
}
