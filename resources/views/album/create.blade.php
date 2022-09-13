
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Création d'un album</h1>
        
    </div>
        

        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('album.store')}}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="titre" class="form-label">nom de l'album</label>
                            <input type="text" name="titre" class="form-control">
                          </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="annee" class="form-label">annee de creation de l'album</label>
                            <input type="month" name="annee" class="form-control">
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
                            <label for="groupe">Groupe production Album</label>
                            <select name="groupe" class="form-select" aria-label="Default select example">
                                <option>Groupe de l'album</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{$groupe->id}}">{{$groupe->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-6">
                            <label for="img">Image de l'album</label>
                            <input type="file" name='img'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="descImg">Description courte la photo de l'album</label>
                            <textarea name="descImg" cols="120" rows="5"></textarea>
                        </div>
                    </div>


                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
