@extends('layouts.main')

@section('title','123milhas - Produtos')

@section('content')

<h1>esta é a página de produtos</h2>

@if($busca != '')
    Buscar por: {{$busca}}
@endif

@endsection