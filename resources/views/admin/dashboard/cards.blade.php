@extends('admin.dashboard')

@section('option')

    <div class="row">

        @if (session()->has('message'))
            <div class="col col-12">
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            </div>
        @endif

        @forelse ($cards as $card)
        <div class="col col-lg-2 col-md-3 col-sm-4" style="margin-bottom: 25px">
            <div class="card">
                <div class="card-header">
                    {{$card->name}}

                    <button class="btn btn-md" id='btnup'><i class="fas fa-pen-square"></i></button>
                </div>
                <div class="card-body bg-secondary">
                <img style='max-width: 100px;' src="{{asset($card->image)}}" alt="">
                </div>
                <div class="card-footer">
                    valor = {{$card->valor}}
                </div>
            </div>
        </div>

        <div class="col col-12 col-md-12 col-lg-12 col-sm-12" id='formupdate' style="display: none; margin-top: 25px; margin-bottom:25px;">
        <div class="card" >
            <div class="card-body ">
                <br>
                <div class="row justify-content-center" >
                    <div class="col col-12 col-md-8 col-lg-9 col-sm-8">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('cardup', ['id' => $card->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" value="{{$card->name}}" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="number" class="form-control" value="{{$card->valor}}" id="valor" name="valor" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Imagem</label>
                                <input type="file" class="form-control" value="{{$card->image}}" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block btn-lg">Atualizar</button>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
        </div>

        @empty
        <div class="alert alert-warning">
            Não há cartas cadastradas!!
        </div>
        @endforelse
    </div>





    <script>
        var formupdates = document.querySelectorAll('#formupdate');
        var btnups = document.querySelectorAll('#btnup')

        for (let index = 0; index < btnups.length; index++) {
            btnups[index].addEventListener("click", function(){
                console.log(formupdates[index].style.display);
                if(formupdates[index].style.display == 'none'){
                    formupdates[index].style.display = 'inline';
                }
                else if(formupdates[index].style.display == 'inline'){
                    formupdates[index].style.display = 'none';
                }
            })
        }



    </script>

@endsection
