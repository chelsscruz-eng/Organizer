@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="mb-4">
                    <h2>Nova tasca</h2>
                    <p class="text-muted mb-0">
                        Projecte: {{ $project->name }}
                    </p>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('tasks.insert') }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name" id="name" class="form-control"value="{{ old('name') }}"required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripció</label>
                                <textarea name="description" id="description" class="form-control" rows="4"required>
                                    {{ old('description') }}
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="due_date" class="form-label">Data límit</label>
                                <input type="date" name="due_date" id="due_date" class="form-control"value="{{ old('due_date') }}"required>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('projects.show', $project->id) }}"class="btn btn-secondary">
                                    Cancel·lar
                                </a>
                                <button type="submit"class="btn btn-dark">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection