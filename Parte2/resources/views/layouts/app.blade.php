<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3DB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Lab3DB</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cursos.index') }}">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('estudiante_curso.index') }}">Inscripciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('asistencias.index') }}">Asistencias</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
