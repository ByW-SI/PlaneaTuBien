@component('mail::message')
# ¡Muchas gracias por tu pago de inscripción!


El identificador del cargo es el siguiente: {{$payment->statement_descriptor}}

@component('mail::table')
| DESCRIPCIÓN           | MONTO                             |
|:--------------:       |:---------------------------------:|
| Pago de inscripción   | ${{$payment->transaction_amount}} |
@endcomponent
{{-- @component('mail::button', ['url' => '#'])
Ver mi pedido
@endcomponent --}}
Gracias,<br>
PlaneaTuBien
@endcomponent
