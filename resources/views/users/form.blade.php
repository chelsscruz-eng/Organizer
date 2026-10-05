@extends('layouts.admin')

@section('content')

    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">
                {{ $mode === 'add' ? 'Nuevo usuario' : 'Editar usuario' }}
            </h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body">
            <form method="POST" action="{{ $mode === 'add' ? route('users.insert') : route('users.update') }}">
                @csrf
                @if($mode === 'edit')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control"value="{{ old('name', $mode === 'edit' ? $user->name : '') }}"
                            required
                        >
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $mode === 'edit' ? $user->username : '') }}"
                            required
                        >
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"value="{{ old('email', $mode === 'edit' ? $user->email : '') }}">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="operator"
                                {{ old('type', $mode === 'edit' ? $user->type : '') === 'operator' ? 'selected' : '' }}>
                                Operador
                            </option>
                            <option value="admin"
                                {{ old('type', $mode === 'edit' ? $user->type : '') === 'admin' ? 'selected' : '' }}>
                                Administrador
                            </option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">
                            Contrasenya
                        </label>
                        <input type="password"name="password"id="password"class="form-control"{{ $mode === 'add' ? 'required' : '' }}>
                        @if($mode === 'edit')
                            <small class="text-muted">
                                Deixa aquest camp buit si no vols canviar la contrasenya.
                            </small>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3"><a href="{{ route('users.index') }}"class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection