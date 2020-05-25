<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>AdminLTE 3 | Starter</title>
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- NAvbar -->
      @include('student.layouts.navbar')

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
          <span class="brand-text font-weight-light">Elearning</span>
        </a>
        @include('student.layouts.sidebar')
      </aside>

      <!-- Heading & Breadcumb-->
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('heading')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @yield('breadcumb')
                </ol>
              </div>
            </div>
          </div>
        </div>

      <!-- Content -->
        <div class="content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
      </div>

      <!-- Footer -->
      @include('student.layouts.footer')

    </div>

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  </body>
</html>
