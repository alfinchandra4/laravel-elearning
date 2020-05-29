@extends('lecturer.app')

@section('title', 'Detail assignment')

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

@section('content-no-container')
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Assignment</h5>
          <div class="text-muted">Judul</div>
          <div class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, aliquam.</div>
          <div class="text-muted">Deskripsi</div>
          <div class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum rem accusamus ex repellat magnam, impedit, ut, dolor quo ducimus repudiandae aspernatur. Voluptas explicabo nisi, nam voluptates aliquam impedit totam esse!</div>
          <div class="text-muted">Deadline • {{ date('d/m/y H:i:s')}}</div>
          <span class="badge badge-success">OPEN</span>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Est eaque illum incidunt odit dolor numquam ullam velit, nobis, nulla aperiam debitis architecto, repudiandae quae magni expedita dolores error! Minus, ipsa!
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Mahasiswa(30)</h5>
          <ul class="list-group" style="overflow: scroll; height:500px">
            @for ($i = 0; $i < 30; $i++)
                <li class="list-group-item list-group-item-action {{ $i == 4 ? 'active' : '' }} p-2">Cras justo odio</li>
            @endfor
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection


