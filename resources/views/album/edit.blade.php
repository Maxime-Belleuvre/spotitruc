
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>mise à jour de l'album {{($album->titre)}}</h1>
        
    </div>
        

        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('album.update',['album'=>$album])}}">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="titre" class="form-label">nom de l'album</label>
                            <input type="text" name="titre" class="form-control" value="{{$album->titre}}">
                          </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="annee" class="form-label">annee de creation de l'album</label>
                            <input type="datetime" name="annee" class="form-control" value="{{$album->annee}}">
                        </div>
    
                        
                    </div>
                                       
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="groupe">Groupe production Album</label>
                            <select name="groupe" class="form-select" aria-label="Default select example">
                                <option value="{{$album->produit->first()->id}}">{{$album->produit->first()->nom}}</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{$groupe->id}}">{{$groupe->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    

                    
                    <div class="row">
                        <div class="col-6">
                            <label for="descImg">Description courte la photo de l'album</label>
                            <textarea name="descImg" cols="120" rows="5">{{$album->descImg}}</textarea>
                        </div>
                    </div>


                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <form enctype="multipart/form-data" method="Post" action="{{route('album.update',['album'=>$album])}}">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="img">Image de l'album</label>
                            <input type="file" name='img'>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
