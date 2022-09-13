
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Création d'un album</h1>
        
    </div>
        
        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('version_morceau.store')}}">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="titre" class="form-label">nom du morceau de musique</label>
                            <input type="text" name="titre" class="form-control">
                          </div>
                    </div>
                              
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="genre">Genre principale de l'album</label>
                            <select name="genre" class="form-select" aria-label="Default select example">
                                <option>Genre principale de l'album'</option>
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->genre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="album">Album du morceau</label>
                            <select name="album" class="form-select" aria-label="Default select example">
                                <option>Groupe de l'album</option>
                                @foreach($albums as $album)groupe)
                                    <option value="{{$album->id}}">{{$album->titre}}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control" name="numero_piste" placeholder="numero de la piste">
                        </div>
                        <div class="mb-3 col-3">
                            <label for="artiste">Interprête morceau</label>
                            <select name="artiste" class="form-select" aria-label="Default select example">
                                <option>Interpretre version</option>
                                @foreach($artistes as $artiste)
                                    <option value="{{$artiste->id}}">{{$artiste->nom}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control" name="role" placeholder="rôle de l'artiste">
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-6">
                            <label for="filepath">son du morceau</label>
                            <input type="file" name='filepath'>
                        </div>
                    </div>
                    
                   
                    

                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
