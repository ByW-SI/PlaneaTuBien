@component('mail::message')
# ¡Muchas gracias por tu compra!

Tu orden no. 0022343 ha sido creada!

Resumen del pedido:

@component('mail::table')
| Producto       | Cantidad         | Total  |
|:------:   |:-----------:|:--------: |
| Descripcion producto   | 10 |   $300 |
| Nombre promocion    | 1 |  $200 |
| Envio       |          | $300 |
| Total       |          | $3100  |
@endcomponent
@component('mail::button', ['url' => '#'])
Ver mi pedido
@endcomponent
Gracias,<br>
Farmacia
@endcomponent
