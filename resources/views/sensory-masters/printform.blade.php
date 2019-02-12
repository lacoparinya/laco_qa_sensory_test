@extends('layouts.print')

@section('content')
    @php
        echo QrCode::size(500)->generate('https://google.com');
    @endphp
@endsection