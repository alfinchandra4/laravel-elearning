@extends('student.app')

@section('title', 'Daftar materi')

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
  <h4 class="font-weight-bold ">Materi</h4>
  <div class="card" style="width: 100%">
    <div class="card-body">
    <table class="table table-hover table-striped" id="datatable">
      <thead>
        <tr>
          <th class="text-left" style="width: 10%">Tanggal</th>
          <th class="text-left">Materi</th>
          <th>Pengajar</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @php
            $lessons = App\Lesson::orderByDesc('created_at')->get();
        @endphp
        @foreach ($lessons as $lesson)
            <tr>
              <td>{{ date('d/m/y', strtotime($lesson->created_at)) }}</td>
              <td>{{ $lesson->title }}</td>
              <td>{{ $lesson->lecturer->name }}</td>
              <td>
                <a href="{{ route('student.public.lesson.enroll', $lesson->id) }}" class="btn btn-sm btn-secondary">Enroll</a>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection

