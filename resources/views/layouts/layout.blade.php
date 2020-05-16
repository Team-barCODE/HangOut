<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header class="header">
        <ul class="list-group-horizontal nav align-items-center">
            <li class="col-5 mb-2 mt-2 text-center">
                <a href="/users/show/{{Auth::id()}}">
                    <i class="fas fa-user fa-2x"></i>
                </a>
            </li>
            <li class="col-2 mb-2 mt-2 text-center">
                <a class="" href="{{route('home')}}">
                    <img class="img-fluid" src="/storage/images/techpit-match-icon.png">
                </a>
            </li>
            <li class="col-5 mb-2 mt-2 text-center">
                <nav>
                    <button class="hamburgeranime">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                    </button>
                </nav>
            </li>
        </ul>
	</header>

    @include('layouts.header')

    @yield('content')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>


    @yield('script')
</body>
</html>
