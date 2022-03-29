@extends('layouts.main')

@section('title','123milhas - Produtos - Detalhes')

@section('content')

<h1>esta é a página de detalhes do produto</h2>
@if($id != null)
    produto id : {{$id}}
@else
    sem id definido
@endif

@endsection