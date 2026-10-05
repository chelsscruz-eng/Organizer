@extends('layouts.admin')

@section('content')

    <div class="row mb-4">

        <div class="col-sm-12">
            <h2 class="titulo-pagina">Usuarios</h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <a href="{{ route('users.add') }}" class="btn btn-primary">
                        Nou usuari
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Usuari</th>
                            <th>Email</th>
                            <th>Tip</th>
                            <th class="text-end">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td>
                                    {{ $user->email ?? '-' }}
                                </td>
                                <td>
                                    @if($user->type === 'admin')
                                        Administrador
                                    @else
                                        Operador
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user->id) }}"class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('users.delete', $user->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit"class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection