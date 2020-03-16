@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <x-side-nav/>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mein Konto</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Hallo {{auth()->user()->name}}!</p>
                        <p>Willkommen in deinem Konto. </p>
                        <p>Klicke <a href="{{route('need.create')}}">hier</a> um ein Hilfegesuch zu erfassen oder <a
                                href="{{route('need.list')}}">hier</a> um deine Hilfegesuche zu verwalten.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
