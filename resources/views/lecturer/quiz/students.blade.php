@extends('lecturer.app')

@section('title', 'Detail kuis')

@section('css')
<style>
  .card-header {
    border-bottom: 3px solid green;
  }
  .question-choice{
    color:green;
    font-weight: bold;
  }
  .student-choice{
    color:red;
    font-weight: bold;
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
    <div class="alert alert-secondary" role="alert"> Alfin Chandra, Skor: 5/10 </div>
      @for ($i = 0; $i < 9; $i++)
      <div class="card mb-1">
        <div class="card-body pl-3 pb-0" style="padding: 5px">
          <div class="question">1. Petani di indonesia ada berapa?</div>
          <div class="answers">
              <ol type="a">
                <li>Ibu jari</li>
                <li>Ibu Kaki</li>
                <li class="question-choice">Ibu Sud</li>
                <li class="student-choice">Ibu Teh nung</li>
              </ol>
          </div>
        </div>
      </div> 
      @endfor
  </div>
</div>
@endsection
















