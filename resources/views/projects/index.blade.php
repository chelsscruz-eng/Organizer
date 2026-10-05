@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-8">
            <h2 class="titulo-pagina">Proyectos</h2>
        </div>
        <div class="col-sm-4 text-end">
            <a href="{{ route('projects.add') }}" class="btn btn-dark">
                + Nuevo proyecto
            </a>
        </div>
    </div>
    <div class="row">
        @forelse($projects as $project)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card card-admin h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge" style="background-color: {{ $project->category->color }}">
                                    {{ $project->category->name }}
                                </span>
                            </div>
                            @if($project->isClosed())
                                <span class="text-danger fw-bold">Projecte tancat</span>
                            @endif
                        </div>
                        <h4>
                            {{ $project->name }}
                        </h4>
                        <p class="text-muted">  
                            {{ $project->code }}
                        </p>
                        <p>
                            {{ $project->description }}
                        </p>
                        <p class="mb-3">
                            <strong>Propietario:</strong>
                            {{ $project->owner->name }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('projects.show', $project->id) }}"
                            class="btn btn-dark">
                                Ver proyecto
                            </a>
                            @if($project->owner_id === auth()->id())
                                <form method="POST"
                                    action="{{ route('projects.delete', $project->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="mb-0">
                            No tienes proyectos todavía.
                        </h6>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection