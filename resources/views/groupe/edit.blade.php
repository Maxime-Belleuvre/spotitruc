
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Création d'un artiste</h1>
        
    </div>
        

        <div class="row">
            <div class="col-6">
                <form enctype="multipart/form-data" method="Post" action="{{route('groupe.update',['groupe'=>$groupe])}}">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="nom" class="form-label">nom du groupe</label>
                            <input type="text" name="nom" class="form-control" value='{{$groupe->nom}}'>
                          </div>
      
                          <div class="mb-3 col-3">
                            <label for="nationalite" class="form-label">nationalité du groupe</label>
                            <input type="text" name="nationalite" class="form-control" value='{{$groupe->nationalite}}'>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="mb-3 col-3">
                            <label for="date_creation" class="form-label">date de creation du groupe</label>
                            <input type="datetime" name="date_creation" class="form-control" value='{{$groupe->date_creation}}'>
                        </div>
    
                        <div class="mb-3 col-3">
                            <label for="date_destruction" class="form-label">date de destruction du groupe</label>
                            <input type="datetime" name="date_destruction" class="form-control" value="{{$groupe->date_destruction}}">
                        </div>
                    </div>
                                    
                        <div class="col-6">
                            <label for="descImg">Description courte la photo du groupe</label>
                            <textarea name="descImg" cols="120" rows="5">{{$groupe->descImg}}</textarea>
                        </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
            <div class="row">

                <form enctype="multipart/form-data" method="Post" action="{{route('groupe.update',['groupe'=>$groupe])}}">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="img">Image du groupe</label>
                            <input type="file" name='img'>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        
    @endsection
