
    @extends('layouts.app')

    @section('content')
    <div class="row">
        <h1>Page de mise à jour de {{$artiste->pseudo}}</h1>
        
    </div>
        

        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="Post" action="{{route('artiste.update',["artiste"=>$artiste])}}">

                    
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="nom" class="form-label">nom de l'artiste</label>
                                    <input type="text" name="nom" class="form-control" value="{{$artiste->nom}}" >
                                  </div>
              
                                  <div class="mb-3 col-6">
                                      <label for="prenom" class="form-label">prénom de l'artiste</label>
                                      <input type="text" name="prenom" class="form-control" value="{{$artiste->prenom}}">
                                  </div>
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="date_naissance" class="form-label">date de naissance l'artiste</label>
                                    <input type="date" name="date_naissance" class="form-control" value="{{$artiste->date_naissance}}">
                                </div>
            
                                <div class="mb-3 col-6">
                                    <label for="date_deces" class="form-label">date de décés de l'artiste</label>
                                    <input type="date" name="date_deces" class="form-control" value="{{$artiste->date_deces}}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="nationalite" class="form-label">nationalité de l'artiste</label>
                                    <input type="text" name="nationalite" class="form-control" value="{{$artiste->nationalite}}">
                                </div>
            
                                <div class="mb-3 col-6">
                                    <label for="pseudo" class="form-label">Pseudonyme de l'artiste</label>
                                    <input type="text" name="pseudo" class="form-control" value="{{$artiste->pseudo}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                
                                <div class="col-4">
                                    <h5>photo actuelle</h5>
                                    <img src="{{asset('storage/'.$artiste->img)}}" style="height:150px"alt="">
                                </div>
                                
                            </div>
        
                            <div class="col-6">
                                    <input type="hidden" name='img' accept="image/*">                                                                       
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="descImg">Description courte la photo de l'artiste</label>
                                    <textarea name="descImg" cols="120" rows="5">{{$artiste->descImg}}</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Modifier">
                    </div>
                    
                    
                    


                    
                    
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="col-6">

                    <form enctype="multipart/form-data" method="Post" action="{{route('artiste.update',["artiste"=>$artiste])}}">

                        @csrf
                        @method('put')
                        
                        <label for="img">Modifier l'image</label>
                        <input type="file" name='img' accept="image/png, image/jpeg">

                        <input type="submit" class="btn btn-primary" value="Modifier">
                    </form>

                </div>
            </div>
        </div>
    @endsection
