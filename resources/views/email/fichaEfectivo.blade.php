@component('mail::message')
# Bienvenido a {{ config('app.name') }}

# Estimad@ {{$cliente->nombre}} {{$cliente->paterno}} {{$cliente->materno}}:

Se adjunta la ficha para el pago en efectivo que usted solicito.


Saludos cordiales.

{{ config('app.name') }}
@endcomponent