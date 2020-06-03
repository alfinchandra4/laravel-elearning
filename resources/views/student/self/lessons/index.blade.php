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
  <h4 class="font-weight-bold">Materi saya</h4>
  <div class="card">
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
            $students_enrolled = App\Studentsenrolled::where('student_id', student()->id)->orderByDesc('created_at')->get();
        @endphp
        @foreach ($students_enrolled as $enroll)
            <tr>
              <td>{{ date('d/m/y', strtotime($enroll->created_at)) }}</td>
              <td>{{ $enroll->lesson->title }}</td>
              <td>{{ $enroll->lesson->lecturer->name }}</td>
              <td>
                <a href="{{ route('student.self.lesson.detail', $enroll->lesson_id) }}" class="btn btn-sm btn-secondary">Lihat</a>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection

