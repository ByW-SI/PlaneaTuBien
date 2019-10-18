@component('mail::message')
# Bienvenido a {{ config('app.name') }}

# Estimad@ {{$prospecto->nombre}} {{$prospecto->appaterno}} {{$prospecto->apmaterno}}:

Se adjunta la cotización que usted solicito.


Saludos cordiales,

{{$asesor->nombre." ".$asesor->paterno." ".$asesor->materno}}

Teléfono. 55 3683 4999
{{ config('app.name') }}
@endcomponent