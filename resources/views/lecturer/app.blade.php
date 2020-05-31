<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>@yield('title')</title>

  <!-- Bootstrap 4 CSS Datatables-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>

  <!-- Toast CSS -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

  @yield('css')
  <!-- Fonr Awesome CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- TinyMCE -->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
      branding: false,
      resize: false
    });
  </script>

</head>
<body style="background-color: #f9f9f9">

@include('sweetalert::alert')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Elearning</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      @php
          $route         = Route::currentRouteName();
          $arrLesson     = ['lecturer.index', 'lecturer.lesson.create', 'lecturer.lesson.edit'];
          $arrAssignment = ['lecturer.assignment.index', 'lecturer.assignment.create', 'lecturer.assignment.detail'];
          $arrQuiz       = [
            'lecturer.quiz.index', 
            'lecturer.quiz.detail',
            'lecturer.quiz.question',
            'lecturer.quiz.student',
          ];
      @endphp
      <li class="nav-item {{ in_array($route, $arrLesson) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lecturer.index') }}">Materi</a>
      </li>
      <li class="nav-item {{ in_array($route, $arrAssignment) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lecturer.assignment.index') }}">Assignments</a>
      </li>
      <li class="nav-item {{ in_array($route, $arrQuiz) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lecturer.quiz.index') }}">Kuis</a>
      </li>
    </ul>
    <span class="navbar-text">
       <li class="nav-item dropdown" style="list-style: none">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::guard('lecturer')->user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-dark" href="/logout">Logout</a>
        </div>
      </li>
    </span>
  </div>
</nav>

<!-- Content -->
<div class="mt-2 mb-3 container">
  @yield('content')
</div>
<div class="p-3">
  @yield('content-no-container')
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 Datatables-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Toast -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Datatables Starter -->
    <script>
      $(document).ready(function() {
        $('#datatable').DataTable();
      } );
    </script>

    <!-- Custom JS -->
    @yield('js')

    @yield('modal')

</body>
</html>