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
        <h5>Assignment</h5>
          <span class="badge badge-success">OPEN</span> 
          <div class="text-muted">Judul</div>
          <div class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, aliquam.</div>
          <div class="text-muted">Deskripsi</div>
          <div class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum rem accusamus ex repellat magnam, impedit, ut, dolor quo ducimus repudiandae aspernatur. Voluptas explicabo nisi, nam voluptates aliquam impedit totam esse!</div>
          <div class="text-muted">Deadline • {{ date('d/m/y H:i:s')}}</div>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="card-title"> Mahasiswa </div>
          <div class="font-weight-bold">Jawaban</div>
          <div class="fot-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Est eaque illum incidunt odit dolor numquam ullam velit, nobis, nulla aperiam debitis architecto, repudiandae quae magni expedita dolores error! Minus, ipsa!
          </div>
          <ul class="list-group list-group-flush for-files">
            <li class="list-group-item">File.doc</li>
            <li class="list-group-item">Presentation.ppt</li>
            <li class="list-group-item">VideoFunny.mp4</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <span class="h5">Mahasiswa </span><span class="text-muted">(30)</span>
      <table class="table table-sm table-hover">
        @for ($i = 0; $i < 30; $i++)
        <tbody>
          <tr>
            <td></td>
            <td><input type="checkbox" class="form-check-input"><a href="#">Check me out</a></td>
            <td><div class="text-muted" style="font-size: 10pt;">29/05/20 13:25</div></td>
          </tr>
        </tbody>
        @endfor
      </table>
    </div>
    </div>
  </div>
@endsection


