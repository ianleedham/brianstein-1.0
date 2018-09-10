<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124818938-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-124818938-2');
    </script>

    <style>
        @media only screen and (min-width: 1000px) {
            .my-content {
                padding: 4rem
            }
        }
        @media only screen and (max-width: 1000px) {
            .my-content {
                padding: 0.5rem
            }
        }
    </style>

</head>
<body>

@include('inc.responsive-navbar')

<div id="app" >
    @include('inc.messages')

    <div class="my-content">
        @yield('content')
    </div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>



</html>

