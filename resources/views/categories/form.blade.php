@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">
                {{ $mode === 'add' ? 'Nova categoria' : 'Editar categoría' }}
            </h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body">
            <form method="POST" action="{{ $mode === 'add' ? route('categories.insert') : route('categories.update') }}">
                @csrf
                @if($mode === 'edit')
                    <input type="hidden" name="id" value="{{ $category->id }}">
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" 
                        value="{{ old('name', $mode === 'edit' ? $category->name : '') }}"required
                    >
                </div>
                <div class="mb-4">
                    <label for="color" class="form-label">
                        Color
                    </label>
                    <input type="color" name="color" id="color" class="form-control form-control-color"
                           value="{{ old('color', $mode === 'edit' ? $category->color : '#000000') }}"
                           required
                    >
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('categories.index') }}"class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-dark">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection