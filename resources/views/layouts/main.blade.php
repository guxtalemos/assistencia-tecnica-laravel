<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Arial" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <header class="border-bottom py-2 bg-white">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center px-4">

            <a class="navbar-brand fs-4 text-dark fw-normal" href="/">
                Assistência Técnica GK
            </a>

            <nav>
                <ul class="nav custom-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/equipaments/create">Cadastrar Equipamento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/manutencoes/create">Cadastrar Manutenção</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Meus Equipamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Minhas Manutenções</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <a href="/logout" class="nav-link"
                                    onclick="event.preventDefault();this.closest('form').submit();">Sair</a>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Cadastrar</a>
                        </li>
                    @endguest
                </ul>
            </nav>

        </div>
    </header>

    <main class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
            </div>
            @yield('content')
    </main>

    <footer class="border-top py-3 text-center text-muted mt-5">
        <p class="mb-0">Sistema de Assistência Técnica &copy; 2026</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
