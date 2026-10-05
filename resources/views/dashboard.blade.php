@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-12"><h2 class="titulo-pagina">Organizer</h2></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card card-admin">
                <div class="card-body">
                    <h4>Proyectos</h4>
                    <h6>Gestiona tus proyectos.</h6>
                    <a href="{{ route('projects.index') }}" class="btn btn-dark">Ver proyectos</a>
                </div>
            </div>
        </div>
        @if(auth()->user()->type === 'admin')
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-admin">
                    <div class="card-body">
                        <h4>Usuarios</h4>
                        <p>Gestiona los usuarios.</p>
                        <a href="{{ route('users.index') }}" class="btn btn-dark">
                            Ver usuarios
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-admin">
                    <div class="card-body">
                        <h4>Categorías</h4>
                        <h6>Gestiona las categorías.</h6>
                        <a href="{{ route('categories.index') }}" class="btn btn-dark">
                            Ver categorías
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>


@endsection