@extends('lecturer.app')

@section('title', 'Daftar materi')

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
    <a href="{{ route('lecturer.lesson.create') }}">Tambah materi</a>
    <div class="card">
      <div class="card-header bg-warning">
        <div class="h5">Materi</div>
      </div>
      <div class="card-body">
          <table class="table table-striped table-hover table-sm" id="datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Materi</th>
                <th>Dokumen</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $lecturer_id = lecturer()->id;
                  $lecturer_lessons = App\lesson::where('lecturer_id', $lecturer_id)->get();
              @endphp
              @foreach ($lecturer_lessons as $lesson)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lesson->title }}</td>
                <td>{{ $lesson->lesson_files->count() }}</td>
                <td>
                  <a href="{{ route('lecturer.lesson.edit', $lesson->id) }}">Detail</a>
                  -
                  <a href="{{ route('lecturer.lesson.delete', $lesson->id) }}">Hapus</a>
                </td>
              </tr>                  
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
@endsection

@section('js')
@endsection

