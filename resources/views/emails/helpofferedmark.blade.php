@component('mail::message')
<strong>Hallo {{$need->user->name}}</strong>

Jemand hat auf dein Hilfegesuch «{{$need->title}}» reagiert.

<strong>Kontaktdaten:</strong><br>
Name: {{$helper['name']}}<br>
E-Mail: <a href="mailto:{{$helper['email']}}">{{$helper['email']}}</a><br>
Telefon: {{$helper['phone']}}<br>

<strong>Nachricht:</strong><br>
{!! nl2br(e($helper['message'])) !!}


Dein Hilfegesuch wurde deaktiviert, du kannst es in <a href="{{route('home')}}">deinem Konto</a> bei Bedarf wieder reaktivieren.
@endcomponent
