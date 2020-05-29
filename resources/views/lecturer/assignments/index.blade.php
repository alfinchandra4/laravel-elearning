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
    <a href="{{ route('lecturer.assignment.create') }}">Tambah assignment</a> |
    <a href="#" data-toggle="modal" data-target="#exampleModal">Notifikasi</a> | 

    <div class="card">
      <div class="card-header bg-warning">
        <div class="h5">Assignment</div>
      </div>
      <div class="card-body">
      <div class="input-group mb-3">
        <input type="text" class="form-control col-md-6" placeholder="Masukkan judul assignment">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </div>
        @php
          $assignments = App\Assignment::where('lecturer_id', auth()->guard('lecturer')
          ->user()->id)->orderByDesc('created_at')->paginate(10);
        @endphp
        @foreach ($assignments as $ass)
        <div class="card mb-1">
          <div class="card-body" style="padding:10px">
            <div class="row">
              <div class="part-no col-md-1">
                <div class="no text-muted" style="font-size: 10pt">No.</div>
                <div>{{ ($assignments->currentpage()-1) * $assignments->perpage() + $loop->index + 1 }}</div>
              </div>
              <div class="part-title col-md-5">
                <div class="title text-muted" style="font-size: 10pt">Judul</div>
                <div>{{ $ass->title }}</div>
              </div>
              <div class="part-participants col-md-2">
                <div class="participants text-muted" style="font-size: 10pt">Partisipan</div>
                <div>
                  6 Mahasiswa
                </div>
              </div>
              <div class="part-deadline col-md-2">
                <div class="deadline text-muted" style="font-size: 10pt">Deadline</div>
                <div>{{ date('d/m/y H:i', strtotime($ass->deadline)) }}</div>
              </div>
              <div class="part-options col-md-2">
                <div class="options text-muted" style="font-size: 10pt">Opsi</div>
                <div>
                  <span class="badge badge-primary">Detail</span>
                  <span class="badge badge-secondary">Ubah</span>
                  <span class="badge badge-danger">Hapus</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <div>
          {{ $assignments->links() }}
        </div>
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

