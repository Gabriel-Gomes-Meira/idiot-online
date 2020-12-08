@extends('admin.dashboard')

@section('option')

    <table class="table bg-dark table-bordered">
        <thead class="bg-dark text-light text-center">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Criado em</th>
            </tr>
        </thead>

        @forelse ($Users as $User)

            <tbody class="bg-light text-secondary">
                <th>
                    {{$User->name}}
                </th>

                <th>
                    {{$User->email}}
                </th>

                <th>
                    {{date('d/m/Y H:i:s',strtotime($User->created_at))}}
                </th>
            </tbody>

        @empty
            <div class="alert alert-danger" role="alert">
                Não há Jogadores cadastrados.
            </div>
        @endforelse

    </table>


@endsection


