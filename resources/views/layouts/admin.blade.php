<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Organizer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        Organizer
                    </a>
                    @auth
                        <div class="d-flex align-items-center">
                            <span class="text-white me-3">
                                {{ auth()->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </nav>
        </header>
        <main class="container-fluid py-4">
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        @yield('postscripts')

    </body>
</html>