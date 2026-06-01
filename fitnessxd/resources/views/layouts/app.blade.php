<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessApp – @yield('title', 'Inicio')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #212529 0%, #343a40 100%);
        }
        .sidebar .nav-link {
            color: #adb5bd;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }
        .sidebar .nav-link i { width: 20px; }
        .sidebar-brand {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
        }
        .main-content { min-height: 100vh; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,.07); }
    </style>
    @stack('styles')
</head>
<body>

<div class="d-flex">
    {{-- SIDEBAR --}}
    <nav class="sidebar d-flex flex-column p-3" style="width: 240px; min-width: 240px;">
        <a href="{{ route('dashboard') }}" class="sidebar-brand mb-4">
            <i class="bi bi-lightning-charge-fill text-warning"></i> FitnessApp
        </a>

        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rutinas.index') }}"
                   class="nav-link {{ request()->routeIs('rutinas.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Rutinas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historial.index') }}"
                   class="nav-link {{ request()->routeIs('historial.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> Historial
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('registro-pesos.index') }}"
                   class="nav-link {{ request()->routeIs('registro-pesos.*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i> Registro de Peso
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('perfil') }}"
                   class="nav-link {{ request()->routeIs('perfil') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Mi Perfil
                </a>
            </li>
        </ul>

        {{-- Usuario y logout al fondo --}}
        <div class="border-top border-secondary pt-3 mt-2">
            @auth
                <p class="text-white-50 small mb-1">
                    <i class="bi bi-person-fill"></i> {{ Auth::user()->name }}
                </p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            @else
                <p class="text-white-50 small mb-1">
                    <i class="bi bi-person-fill"></i> Sin sesión iniciada
                </p>
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                </a>
            @endauth
        </div>
    </nav>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="main-content flex-grow-1 p-4">

        {{-- Alertas flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>