<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
            crossorigin="anonymous">
        <link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <title>Planea tu bien</title>
    </head>
    <body>
        <div>
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
    <!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you 
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fa/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/es.js"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // initialize with defaults
        $("#input-id").fileinput();
         
        // with plugin options
        $("#input-id").fileinput({
          'showUpload':false,
          'language': 'es', 
          'previewFileType':'any',
        });
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        $("#notificacion").on("click",'button',function () {
          $(this).parent().parent().hide();
        });
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