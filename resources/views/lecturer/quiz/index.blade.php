@extends('lecturer.app')

@section('title', 'Daftar kuis')

@section('css')
    <style>
    .dataTables_filter {
        width: 50%;
        float: right;
        text-align: right;
      }
      .card-header,
      .modal-header {
        border-bottom: 3px solid green;
      }
    </style>
@endsection

@section('content')
    <a href="#" data-toggle="modal" data-target="#quizCreate">Tambah kuis</a>
    <div class="card">
      <div class="card-header bg-warning">
        <div class="h5">Kuis</div>
      </div>
      <div class="card-body"> 
        <div class="list-group">
          @php
              $quizzes = App\Quizzes::where('lecturer_id', lecturer()->id)
                                    ->orderByDesc('created_at')
                                    ->get();
          @endphp
          @foreach ($quizzes as $quiz)
            <a href="{{ route('lecturer.quiz.detail', $quiz->id) }}" class="list-group-item list-group-item-action">
              {{ $quiz->title }}
              <div class="float-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
            </a>              
          @endforeach
        </div>
      </div>
    </div>
@endsection

@section('modal')
  <!-- Modal Create-->
<div class="modal fade" id="quizCreate" tabindex="-1" role="dialog" aria-labelledby="quizCreateLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="h5">Tambah kuis</div>
        <form action="{{ route('lecturer.quiz.store') }}" method="post" id="create_quiz_frm">
          @csrf
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="height: 200px"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="create_quiz_frm">Buat kuis</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection

