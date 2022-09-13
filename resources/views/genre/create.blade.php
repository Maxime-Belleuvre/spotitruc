
    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col">
                <h1>Création d'un nouveau genre de musique</h1> 
            </div>
            
        </div>

        <div class="row">
            <div class="col">
                <form method="Post" action="{{route('genre.store')}}">
                    @csrf
                    <div class="mb-3">
                      <label for="genre" class="form-label">nouveau genre</label>
                      <input type="text" name="genre" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection

