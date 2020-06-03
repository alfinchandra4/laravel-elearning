@extends('student.app')

@section('title', 'Daftar assignment saya')

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
  <h4 class="font-weight-bold ">Assignments saya</h4>
  <div class="card" style="width: 100%">
    <div class="card-body">
    <table class="table table-hover table-striped" id="datatable">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-left">Judul</th>
          <th class="text-left" style="width: 15%">Deadline</th>
          <th>Pengajar</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        @php
            $assignments = App\Assignment::whereIn('id', function($q) {
              $q->select('assignment_id')
                ->from('student_assignments')
                ->where('student_id', student()->id);
            })->orderByDesc('deadline')->get();
        @endphp
        @foreach ($assignments as $assignment)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $assignment->title }}</td>
              <td>
                @php
                    $deadline = date('Y-m-d H:i:s', strtotime($assignment->deadline));
                    $today    = date('Y-m-d H:i:s');
                @endphp
                @if ($today <= $deadline)
                    <span class="badge badge-success">OPEN {{ $deadline }}</span>
                @else
                    <span class="badge badge-danger">CLOSED {{ $deadline }}</span>
                @endif
              </td>
              <td>{{ $assignment->lecturer->name }}</td>
              <td>
                <a href="{{ route('student.self.assignment.detail', $assignment->id) }}" class="btn btn-sm btn-secondary">Lihat</a>
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection

