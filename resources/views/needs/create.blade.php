@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <x-side-nav/>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hilfegesuch erstellen</div>

                    <div class="card-body">
                        <p class="mb-4">Worin brauchst du Hilfe? Beim Einkaufen, bei der Kinderbetreuung, beim Hausaufgabenmachen, etc.? Hier kannst du es aufschreiben: </p>
                        <form method="POST" action="{{ route('need.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}
                                    *</label>

                                <div class="col-md-7">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small>Sage mit eins bis zwei Wörtern, um was es geht.</small>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="preview" class="col-md-4 col-form-label text-md-right">{{ __('Preview') }}
                                    *</label>

                                <div class="col-md-7">
                                    <input id="preview" type="text"
                                           class="form-control @error('preview') is-invalid @enderror" name="preview"
                                           value="{{ old('preview') }}" required>
                                    @error('preview')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small>Beschreibe in einem Satz, was du brauchst.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }} *</label>

                                <div class="col-md-7">
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="6" required></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small>Beschreibe etwas ausführlicher, was du brauchst. Am besten mit Zeit, Ort, Datum – je konkreter, desto besser.</small>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-7 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
