
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Création d'un artiste</h1>
        
    </div>
        

        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('artiste.store')}}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="nom" class="form-label">nom de l'artiste</label>
                            <input type="text" name="nom" class="form-control">
                          </div>
      
                          <div class="mb-3 col-3">
                              <label for="prenom" class="form-label">prénom de l'artiste</label>
                              <input type="text" name="prenom" class="form-control">
                          </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="date_naissance" class="form-label">date de naissance l'artiste</label>
                            <input type="date" name="date_naissance" class="form-control">
                        </div>
    
                        <div class="mb-3 col-3">
                            <label for="date_deces" class="form-label">date de décés de l'artiste</label>
                            <input type="date" name="date_deces" class="form-control" value="NULL">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="nationalite" class="form-label">nationalité de l'artiste</label>
                            <input type="text" name="nationalite" class="form-control">
                        </div>
    
                        <div class="mb-3 col-3">
                            <label for="pseudo" class="form-label">Pseudonyme de l'artiste</label>
                            <input type="text" name="pseudo" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="genre">Genre principale de l'artiste</label>
                            <select name="genre" class="form-select" aria-label="Default select example">
                                <option>Genre principale de l'artiste</option>
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->genre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="img">Image de l'artiste</label>
                            <input type="file" name='img'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="descImg">Description courte la photo de l'artiste</label>
                            <textarea name="descImg" cols="120" rows="5"></textarea>
                        </div>
                    </div>


                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
