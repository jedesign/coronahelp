@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <x-side-nav/>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Meine Hilfegesuche</div>

                    <div class="card-body">
                        <p class="mb-4">Hier siehst du alle deine Hilfegesuche. Du kannst sie bearbeiten, aktivieren, deaktivieren und löschen.</p>

                        <ul class="list-group mb-4">
                            @foreach($needs as $need)
                                <li class="list-group-item d-flex justify-content-between align-items-center {{!$need->active?'list-group-item-dark':''}}">
                                    <a href="{{route('need.edit',compact('need'))}}">{{$need->title}}</a>
                                    <div class="d-flex">
                                        <form action="{{route('need.toggle',compact('need'))}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="submit" class="btn btn-sm"
                                                   value="{{$need->active? 'deaktivieren':'aktivieren'}}">
                                        </form>
                                        <form action="{{route('need.delete',compact('need'))}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn text-danger btn-sm" value="löschen">
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{route('need.create')}}" class="btn btn-primary">Hilfegesuch erstellen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
