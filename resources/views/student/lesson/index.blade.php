@extends('student.layouts.app')

@section('heading', 'Lesson Index')

@section('breadcumb')
  <li class="breadcrumb-item"><a href="#">Home</a></li>
  <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('content')
  <h2>Student Page {{ Auth::guard('student')->user()->name }}</h2>
  <br>
  <a href="/logout">Logout {{ Auth::guard('student')->user()->name }} ??</a>
@endsection