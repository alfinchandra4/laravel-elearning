@php
  $route = Route::currentRouteName();
@endphp
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ $route == 'lecturer.quiz.detail' ? 'active' : '' }}" href="{{ route('lecturer.quiz.detail', session('quiz_id')) }}">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $route == 'lecturer.quiz.question' ? 'active' : '' }}" href="{{ route('lecturer.quiz.question', session('quiz_id')) }}">Kuis</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $route == 'lecturer.quiz.student' ? 'active' : '' }}" href="{{ route('lecturer.quiz.student', session('quiz_id')) }}">Student</a>
  </li>
</ul>