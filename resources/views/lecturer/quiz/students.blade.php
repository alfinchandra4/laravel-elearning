@extends('lecturer.app')

@section('title', 'Detail kuis')

@section('css')
<style>
  .card-header {
    border-bottom: 3px solid green;
  }
</style>
@endsection

@section('content')
@include('lecturer.quiz.navtabs')
<div class="row">
  <div class="col-md-6">
    <h4 class="font-weight-bold">Mahasiswa</h4>
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action float-left">
        Alfin Chandra
        <div class="float-right"> 29/05/20 13:25 </div>
      </a>
      <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
      <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
    </div>
  </div>
  <div class="col-md-6">
    <h4 class="font-weight-bold">Jawaban</h4>
    <div class="alert alert-secondary" role="alert">
      A simple secondary alert—check it out!
    </div>
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
      <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
    </div>
  </div>
</div>
@endsection
















