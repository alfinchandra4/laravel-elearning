@extends('lecturer.app')

@section('title', 'Assignments')

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
    <a href="{{ route('lecturer.assignment.create') }}">Tambah assignment</a> •
    <a href="#" data-toggle="modal" data-target="#exampleModal">Notifikasi</a> •  

    <div class="card">
      <div class="card-header bg-warning">
        <div class="h5">Assignment</div>
      </div>
      <div class="card-body">
        @php
          $assignments = App\Assignment::where('lecturer_id', auth()->guard('lecturer')
          ->user()->id)->orderByDesc('created_at')->get();
        @endphp
            <table class="table table-hover table-striped table-hover" id="datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>Partisipan</th>
                  <th>Deadline</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($assignments as $ass)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ Str::words($ass->title, 6) }}</td>
                  <td>6 Mahasiswa</td>
                  <td>{{ date('d/m/y H:i', strtotime($ass->deadline)) }}</td>
                  <td>
                    <span class="badge badge-primary">Detail</span>
                    <span class="badge badge-secondary">Ubah</span>
                    <span class="badge badge-danger">Hapus</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
    </div>
@endsection

@section('modal')
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="h5">Notifikasi terbaru</div>
          <div class="list-group">
            <a href="{{ route('lecturer.assignment.detail') }}" class="list-group-item list-group-item-action">
              <div class="float-left">Lorem ipsum dolor sit amet consectetur</div>
              <div class="float-right font-weight-bold">Alfin Chandra4</div>
              <br/>
              <div class="float-right text-muted" style="font-size: 10pt">Mon, 3/10/19 22:17</div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              <div class="float-left">Lorem ipsum dolor sit amet consectetur</div>
              <div class="float-right font-weight-bold">Alfin Chandra4</div>
              <br/>
              <div class="float-right text-muted" style="font-size: 10pt">Mon, 3/10/19 22:17</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection

