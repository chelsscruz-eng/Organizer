@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-sm-8">
            <h2 class="titulo-pagina">Categorías</h2>
        </div>
        <div class="col-sm-4 text-end">
            <a href="{{ route('categories.add') }}" class="btn btn-dark">
                + Nova categoria
            </a>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Color</th>
                            <th>Vista prèvia</th>
                            <th class="text-end">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->color }}
                                </td>
                                <td>
                                    <span
                                        style="display: inline-block;width: 30px;height: 30px;
                                            background-color: {{ $category->color }};
                                            border: 1px solid #ccc;">
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('categories.delete', $category->id) }}" class="d-inline">
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
    </div>

@endsection