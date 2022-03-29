@extends('layouts.main')

@section('title','123milhas - Passagens - Criar')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu cadastro</h1>
    <form action="/passagens" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titutlo da passagem">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descricao:</label>
            <textarea name="description" class="form-control" id="description" placeholder="o que ocorrerá no evento"></textarea>
        </div>
        <input type="submit" class="btn btn-primary mt-2" value="Criar">
    </form>
</div>

@endsection