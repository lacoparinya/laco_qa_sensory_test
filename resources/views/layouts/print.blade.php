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
<style> 
    @media print {
   @page {
      margin: 0;
    }
    body {
        height: 100%;
        width: 100%;
    }
    div.row > div {
      display: inline-block;  
      border: solid 1px #ccc;
      margin: 0.1cm;
      font-size: 1rem;
    }
    div.row {
      display: block;
      margin: solid 2px black;
      margin: 0.2cm 1cm;
      font-size: 0;
      white-space: nowrap;
    }
    .table {
        transform: translate(8.5in, -100%) rotate(90deg);
        transform-origin: bottom left;
        display: block;
    }

    }
</style>

</head>
<body>
        @yield('content')
</body>
</html>
