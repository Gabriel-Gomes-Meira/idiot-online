@extends('admin.dashboard.rooms')

@section('option')

    {{-- @forelse ($sortedrooms as $room)
        <div class="alert alert-info" role="alert">
            {{$room->name}}
        </div>
    @empty
        <div class="alert alert-danger" role="alert">
            Ainda não foi criada qualquer sala nessa database.
        </div>
    @endforelse --}}
@endsection
