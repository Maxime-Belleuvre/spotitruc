
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Création d'un artiste</h1>
        
    </div>
        

        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('groupe.store')}}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="nom" class="form-label">nom du groupe</label>
                            <input type="text" name="nom" class="form-control">
                          </div>
      
                          <div class="mb-3 col-3">
                            <label for="nationalite" class="form-label">nationalité du groupe</label>
                            <input type="text" name="nationalite" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="date_creation" class="form-label">date de creation du groupe</label>
                            <input type="date" name="date_creation" class="form-control">
                        </div>
    
                        <div class="mb-3 col-3">
                            <label for="date_destruction" class="form-label">date de destruction du groupe</label>
                            <input type="date" name="date_destruction" class="form-control" value="NULL">
                        </div>
                    </div>
                                       
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="genre">Genre principale du groupe</label>
                            <select name="genre" class="form-select" aria-label="Default select example">
                                <option>Genre principale de l'artiste</option>
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->genre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="artiste">Genre principale de l'artiste</label>
                            <select name="artiste" class="form-select" aria-label="Default select example">
                                <option>Un membre du groupe</option>
                                @foreach($artistes as $artiste)
                                    <option value="{{$artiste->id}}">{{$artiste->pseudo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="date_depart" class="form-label">date d'arrivé de l'artiste dans le groupe</label>
                            <input type="date" name="date_depart" class="form-control">
                        </div>
    
                        <div class="mb-3 col-3">
                            <label for="date_fin" class="form-label">date de fin de l'artiste dans le groupe</label>
                            <input type="date" name="date_fin" class="form-control" value="NULL">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="img">Image du groupe</label>
                            <input type="file" name='img'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="descImg">Description courte la photo du groupe</label>
                            <textarea name="descImg" cols="120" rows="5"></textarea>
                        </div>
                    </div>


                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
