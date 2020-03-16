@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <h1 class="display-4">Hilfegesuch</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Worum geht es?</div>

                    <div class="card-body">
                        <h4 class="mb-3">{{$need->title}}</h4>
                        <p>{{$need->preview}}</p>
                        <p>{!! nl2br(e($need->description)) !!}</p>
                    </div>
                </div>
                {{--                <div class="card mb-4">--}}
                {{--                    <div class="card-header">Personalien</div>--}}

                {{--                    <div class="card-body">--}}
                {{--                        <address>--}}
                {{--                            {{$need->user->name}}<br>--}}
                {{--                            {{$need->user->street}}<br>--}}
                {{--                            {{$need->user->plz}} {{$need->user->city}}--}}
                {{--                        </address>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">Kontakt aufnehmen</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('need.contact', compact('need')) }}">
                            @csrf

                            <div class="form-group ">
                                <label for="title" class="col-form-label text-md-right">{{ __('Name') }}
                                    *</label>

                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"
                                       class="col-form-label text-md-right">{{ __('E-Mail Address') }}
                                    *</label>

                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-form-label text-md-right">{{ __('Phone') }} *</label>

                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}" required>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message" class="col-form-label text-md-right">{{ __('Message') }}
                                    *</label>

                                <textarea id="message" class="form-control @error('message') is-invalid @enderror"
                                          name="message" rows="6" required>Hallo {{$need->user->name}}{{"\n"}}Sehr gerne würde ich dir helfen. Am besten meldest du dich bei mir per E-Mail oder per Telefon.{{"\n"}}Liebe Grüsse</textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
