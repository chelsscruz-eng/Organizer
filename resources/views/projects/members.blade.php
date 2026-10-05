@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">Afegir membre</h2>
    <form action="{{ route('projects.addMember', $project->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Usuari</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ $user->username }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-dark">Afegir membre</button>
        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>

@endsection