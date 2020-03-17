{{$need->user->name}} hat ein Hilfegesuch mit dem Titel «{{$need->title}}» erfasst: <br><br>

<strong>Titel:</strong><br>
{{$need->title}} <br><br>

<strong>Vorschau:</strong><br>
{{$need->preview}} <br><br>

<strong>Text:</strong><br>
{!! nl2br(e($need->description)) !!} <br><br>

<strong>Person:</strong><br>
{{$need->user->name}} <br>
{{$need->user->email}} <br>
{{$need->user->plz}} {{$need->user->city}}
