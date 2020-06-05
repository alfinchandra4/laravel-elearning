@extends('student.app')

@section('title', 'Kuis saya')

@section('css')
  <style>
    .dataTables_filter {
      width: 50%;
      float: right;
      text-align: right;
    }
  </style>
@endsection

@section('content')
  <h4 class="font-weight-bold ">Kuis</h4>
  <div class="card" style="width: 100%">
    <div class="card-body">
    <table class="table table-hover table-striped" id="datatable">
      <thead>
        <tr>
          <th class="text-left" style="width: 10%">#</th>
          <th class="text-left">Materi</th>
          <th>Pengajar</th>
          <th style="width: 10%"></th>
        </tr>
      </thead>
      <tbody>
        @php
            $quizzes = App\Quizzes::orderByDesc('created_at')->get();
        @endphp
        @foreach ($quizzes as $quiz)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ Str::words($quiz->title, 15) }}</td>
              <td>{{ $quiz->lecturer->name }}</td>
              <td>
                <a href="{{ route('student.public.quizzes.detail', $quiz->id) }}" class="btn btn-sm btn-secondary">
                  <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                </a>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection

