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
      <div class="card-body">
        <div class="h4">Materi</div>
          <table class="table" id="datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Materi</th>
                <th>Deskripsi</th>
                <th>Opsi</th>
              </tr>
            </thead>
          </table>
      </div>
    </div>
@endsection

@section('js')
@endsection

