@extends('admin.dashboard')

@section('option')

    <table class="table bg-dark table-bordered">
        <thead class="bg-dark text-light text-center">
            <tr>
                <th>Nome</th>
                <th>Hoster</th>
                <th>Guester</th>
                <th>Ganhador</th>
                <th>Criada em</th>
                <th>Finalizado em</th>
            </tr>
        </thead>

        @forelse ($Rooms as $Room)

            <tbody class="bg-light text-secondary">
                <th>
                    {{$Room->name}}
                </th>

                <th>
                    {{$Room->hoster}}
                </th>

                @if ($Room->guester)
                    <th>
                            {{$Room->guester}}
                    </th>
                @else
                    <th class="bg-warning text-dark text-center align-middle">
                        N/A
                    </th>
                @endif

                @if ($Room->winner)
                    <th class="bg-success text-light">
                            {{$Room->winner}}
                    </th>
                @else
                    <th class="bg-warning text-dark text-center align-middle">
                        N/A
                    </th>
                @endif

                <th>
                    {{date('d/m/Y H:i:s',strtotime($Room->created_at))}}
                </th>

                @if ($Room->winner)
                    <th class="bg-success text-light">
                            {{date('d/m/Y H:i:s',strtotime($Room->updated_at))}}
                    </th>
                @else
                    <th class="bg-warning text-dark text-center align-middle">
                        N/A
                    </th>
                @endif
            </tbody>

        @empty
            <div class="alert alert-danger" role="alert">
                Ainda não foi criada qualquer sala nessa database.
            </div>
        @endforelse

    </table>


@endsection


