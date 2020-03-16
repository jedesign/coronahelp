<strong>Hallo {{$need->user->name}}</strong><br>
<br>
Jemand hat auf dein Hilfegesuch «{{$need->title}}» reagiert.
<br><br>
<strong>Kontaktdaten:</strong><br>
Name: {{$helper['name']}}<br>
E-Mail: <a href="mailto:{{$helper['email']}}">{{$helper['email']}}</a><br>
Telefon: {{$helper['phone']}}<br>
<br>
<strong>Nachricht:</strong><br>
{!! nl2br(e($helper['message'])) !!}
<br>
–
<br>
Dein Hilfegesuch wurde deaktiviert, du kannst es in <a href="{{route('home')}}">deinem Konto</a> bei Bedarf wieder reaktivieren.
