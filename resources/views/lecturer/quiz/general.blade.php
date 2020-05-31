@extends('lecturer.app')

@section('title', 'Detail kuis')

@section('css')
  <style>
      .card-header {
        border-bottom: 3px solid green;
      }
      .selected{
          color:green;
          font-weight: bold;
      }
  </style>
@endsection

@section('content')
@include('lecturer.quiz.navtabs')
    <h4 class="font-weight-bold">General</h4>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('lecturer.quiz.update') }}" method="post">
          @csrf
          <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $quiz->title }}" required>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="height: 200px">{{$quiz->description}}</textarea>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>  

@endsection
















