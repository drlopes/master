<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CRUD | {{ ucwords($title) }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" style="color: white; height: 56px;" >
            <div class="container-fluid">
                <div>
                    <a href="{{ route('series.index') }}" class="navbar-brand">HOME</a>
                </div>
                @guest
                    @if ($title != 'login')
                        <span class="navbar-brand">{{ strtoupper($title); }}</span>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm" class="login">Login</a>
                    @endif
                @endguest
                @auth
                    <span class="navbar-brand">{{ strtoupper($title); }}</span>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>
        <div class="container">
             @isset($messageSuccess)
                <div class="alert alert-success">
                    {{ $messageSuccess }}
                </div>
            @endisset
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ $slot }}
        </div>
    </body>
</html>
