<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
            crossorigin="anonymous">
        <title>Planea tu bien</title>
    </head>
    <body>
        <div >
            <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 70px;">
                {{-- header --}}
                <div class="row imagen p-0 m-0">
                </div>
                {{-- NAVBAR --}}
                <div class="row m-0 p-0">
                    <div class="col-12 m-0 p-0">
                        @include('nav')
                    </div>
                </div>
                <!-- Position it -->
                @if (Auth::user()->empleado->cargo == '' || Auth::user()->empleado->cargo == 'Supervisor')
                  <div style="position: absolute; top: 0; right: 0;" id="notificacion">
                  </div>
                @endif
            </div>
        </div>
        <div class="container-fluid py-3">
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

        
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        $("#notificacion").on("click",'button',function () {
          $(this).parent().parent().hide();
        })
        var pusher = new Pusher('402f8ad1b8c66d21fef9', {
          cluster: 'us2',
          encrypted: true,
          forceTLS: true
        });

        var channel = pusher.subscribe('prospecto-created');
        channel.bind('prospecto-creado', function(data) {
          // alert(JSON.stringify(data));
          var notificacion = $("#notificacion");
          var toast = `
            <div class="toast fade show" role="status" aria-live="polite" aria-atomic="true"  data-delay="5000">
              <div class="toast-header">
                <strong class="mr-auto">${data.prospecto.nombre} ${data.prospecto.appaterno} ${data.prospecto.apmaterno}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="toast-body">
                <a href="{{ url('prospectos') }}/${data.prospecto.id}">
                  ${data.mensaje}
                </a>
              </div>
            </div>
          `;
          var not_existentes = notificacion.html();
           notificacion.html(not_existentes + toast);
        });
        // $('.toast').toast('show')  
    </script>
    @stack('scripts')
</html>