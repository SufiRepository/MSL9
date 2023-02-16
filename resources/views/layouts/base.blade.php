<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.headpwa')
    @stack('basehead')

</head>

@include('layout.loginbody')


</html>
