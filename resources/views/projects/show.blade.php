@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="mb-4">
                    <h2 class="mb-3">{{ $project->name }}</h2>
                    <p class="mb-2">
                        <strong>Codi:</strong>
                        {{ $project->code }}
                    </p>
                    <p class="mb-0">
                        <strong>Categoria:</strong>
                        <span class="badge"style="background-color: {{ $project->category->color }}">
                            {{ $project->category->name }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-8 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Informació del projecte</h4>
                        <p class="mb-4">
                            {{ $project->description }}
                        </p>
                        <p class="mb-0">
                            <strong>Propietari:</strong>
                            {{ $project->owner->name }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Membres</h4>
                            @if($project->owner_id === auth()->id() && !$project->isClosed())
                                <a href="{{ route('projects.members', $project->id) }}" class="btn btn-dark btn-sm">
                                    + Afegir
                                </a>
                            @endif
                        </div>
                        <div class="border rounded p-3 mb-2">
                            <strong>{{ $project->owner->name }}</strong>
                            <h6 class="d-block text-muted">Propietari</h6>
                        </div>
                        @forelse($project->users as $user)
                            <div class="border rounded p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <h6 class="d-block text-muted">{{ $user->username }}</h6>
                                    </div>
                                    @if($project->owner_id === auth()->id() && !$project->isClosed())
                                        <form action="{{ route('projects.removeMember', [$project->id, $user->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <h6 class="text-muted text-center mt-4 mb-0">No hi ha membres convidats.</h6>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4>Tasques</h4>
                            @if(!$project->isClosed())
                                <a href="{{ route('tasks.add', $project->id) }}" class="btn btn-dark">
                                    + Nova tasca
                                </a>
                            @endif
                        </div>
                        @forelse($project->tasks as $task)
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="{{ $task->status === 'closed' ? 'text-decoration-line-through' : '' }}">
                                        {{ $task->name }}
                                    </strong>
                                    <p class="mb-1">{{ $task->description }}</p>
                                    <span>Data límit: {{ $task->due_date }}</span>
                                </div>
                                @if($task->status === 'open')
                                    <form action="{{ route('tasks.close', $task->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-dark">✓</button>
                                    </form>
                                @else
                                    <span>✓</span>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted mb-0">No hi ha tasques en aquest projecte.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Tornar als projectes</a>
            </div>
        </div>
    </div>

@endsection