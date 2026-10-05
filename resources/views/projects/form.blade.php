@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">
                {{ $mode === 'add' ? 'Nuevo proyecto' : 'Editar proyecto' }}
            </h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body">
            <form method="POST" action="{{ $mode === 'add' ? route('projects.insert') : route('projects.update') }}">
                @csrf
                @if($mode === 'edit')
                    <input type="hidden" name="id" value="{{ $project->id }}">
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="code" class="form-label">Código</label>
                        <input type="text" name="code"id="code"
                            class="form-control" value="{{ old('code', $mode === 'edit' ? $project->code : '') }}"required
                        >
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $mode === 'edit' ? $project->name : '') }}" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="category_id" class="form-label">
                            Categoría
                        </label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option>
                                Selecciona una categoría
                            </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $mode === 'edit' ? $project->category_id : '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">
                            Descripción
                        </label>
                        <textarea name="description" id="description" class="form-control" rows="4" 
                                required>{{ old('description', $mode === 'edit' ? $project->description : '') }}
                        </textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection