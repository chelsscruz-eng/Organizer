@extends('layouts.auth')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card card-admin mt-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="titulo-pagina"><b>Organizer<b></h2>
                        <p>Iniciar sesión</p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login.authenticate') }}">
                        @csrf
                        <div class="mb-3"><label for="username" class="form-label">Usuario</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                        </div>
                        <div class="mb-4"><label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection