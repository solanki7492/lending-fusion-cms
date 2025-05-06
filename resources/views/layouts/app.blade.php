<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <link rel="manifest" href="assets/favicon/manifest.json">
    
    <link rel="stylesheet" href="/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/free.min.css" rel="stylesheet">

    <link href="/css/main.css" rel="stylesheet">
    <link href="https://unpkg.com/@coreui/icons@2.0.1/css/all.min.css" rel="stylesheet">

    <script src="/js/config.js"></script>
    <script src="/js/color-modes.js"></script>
  </head>
  <body>
    @if(Auth::check())
        @include('layouts.sidebar')
    @endif
    <div class="wrapper d-flex flex-column min-vh-100">
      @if(Auth::check())
          @include('layouts.header')
      @endif
      <div class="body flex-grow-1">
          <div class="container-lg px-4">
          <div class="row">
              <div class="col-md-12">
                  <div class="card-body">
                    @yield('content')
                  </div>
              </div>
          </div>
          </div>
      </div>
      @if(Auth::check())
          @include('layouts.footer')
      @endif
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="/js/coreui.bundle.min.js"></script>
    <script src="/js/simplebar.min.js"></script>
    <script src="https://unpkg.com/@coreui/icons@2.0.1/js/coreui-icons.min.js"></script>

    <script>
      const header = document.querySelector('header.header');

      document.addEventListener('scroll', () => {
        if (header) {
          header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
      });
    </script>
    <script src="/js/main.js"></script>
    <script>
    </script>

  </body>
</html>