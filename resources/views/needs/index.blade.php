@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <h1 class="display-4">Hilfegesuche</h1>
        <p class="lead mb-4">Hier werden alle Bedürfnisse angezeigt. <br>Filtere nach deinem Ort und schaue, wem du helfen kannst.</p>
        <corona-need-view></corona-need-view>
    </div>
@endsection
