@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-2 text-center">{{ config('app.name', 'Laravel') }}</h1>
            <div class="display-4 text-center mb-4">😷 👑 ⛑️</div>
            <p class="lead mb-4">In Zeiten des Coronavirus möchten wir zusammenstehen und einander unterstützen. Wenn du Hilfe benötigst oder du Zeit hast, um jemandem zu helfen, bist du hier genau richtig.</p>
            <p>
                <a class="btn btn-primary btn-lg" href="{{route('need.create')}}" role="button">Ich brauche Hilfe</a>
                <a class="btn btn-primary btn-lg" href="{{route('need.index')}}" role="button">Ich will helfen</a>
            </p>
        </div>
    </div>
@endsection
