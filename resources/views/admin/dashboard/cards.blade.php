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

                    <p class="text-dark" id="limiterstr">{{$card->name}}</p>

                    <button class="btn btn-md" id='btnup'><i class="fas fa-pen-square"></i></button>


                <button class="btn btn-md text-danger" data-toggle="modal" data-target="#dialogbox{{$card->id}}" id='btndel'>
                        <i class="fas fa-trash-alt"></i>
                    </button>


                    <form method="POST" enctype="multipart/form-data" action="{{ route('carddel', ['id' => $card->id]) }}">
                        @csrf
                        <div class="modal fade" id="dialogbox{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="dialogboxTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dialogboxTitle">Confirmar Solicitação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-dark">Tem certeza de que quer deletar a carta <b>{{$card->name}}</b> ?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body bg-secondary">
                    <img style='max-width: 100px;' src="{{asset('/storage/cards/'.$card->image)}}" alt="">
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

        <div class="col col-lg-2 col-md-3 col-sm-4">
            @if($errors->all())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
                @endforeach
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ route('cardadd') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control form-control-sm" value="" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="card-body bg-secondary">
                        <div class="form-group">
                            {{-- <label for="image">Imagem</label> --}}

                            <a  class="btn btn-md btn-block text-white align-middle" id="imageadd"  onclick="turnimageform()">
                                <i class="far fa-plus-square" style="font-size: 3em"></i>
                            </a>

                            {{-- <input type="file" value="" id="imageadd" name="image" class="file_customizada" required> --}}
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="number" class="form-control form-control-sm" value="" id="valor" name="valor" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>


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

        function turnimageform(){
            console.log("chegou aqui!!");
            var image = document.getElementById('imageadd');
            image.outerHTML = '<input type="file" value="" id="imageadd" name="image" class="form-control-file" required="" >';
            console.log(image.assignedSlot);
        }



        var stringers = document.querySelectorAll('#limiterstr');
        stringers.forEach(pelement => {
            if (pelement.textContent.length > 10){
                if (pelement.textContent.toLowerCase().startsWith("v")){
                    pelement.textContent = pelement.textContent.substring(6)
                    pelement.textContent = "V."+pelement.textContent
                }

                if (pelement.textContent.toLowerCase().startsWith("d")){
                    pelement.textContent = pelement.textContent.substring(5)
                    pelement.textContent = "D. "+pelement.textContent
                }

                if (pelement.textContent.toLowerCase().startsWith("r")){
                    pelement.textContent = pelement.textContent.substring(4)
                    pelement.textContent = "R. "+pelement.textContent
                }

                if (pelement.textContent.endsWith("adas") && pelement.textContent.length>10){
                    pelement.textContent = pelement.textContent.substring(0,pelement.textContent.length-3)+'.'
                }

            }

        });



    </script>


@endsection
