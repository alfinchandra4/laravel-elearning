@extends('lecturer.app')

@section('title', 'Tambah materi')

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
  <div class="card">
    <div class="card-header bg-warning">
      <div class="h5">Tambah materi</div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('lecturer.lesson.store') }}" enctype="multipart/form-data" id="myform">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="file">Upload file</label>
              <div class="files">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input custom-file-input-sm" id="inputfile1" name="file[]">
                    <label class="custom-file-label file-label1">Choose file</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input custom-file-input-sm" id="inputfile2" name="file[]">
                    <label class="custom-file-label file-label2">Choose file</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input custom-file-input-sm" id="inputfile3" name="file[]">
                    <label class="custom-file-label file-label3">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
            <small class="text-muted">
              Format yang diperbolehkan
              <ul>
                <li>Dokumen: doc/docx/pdf</li>
                <li>Video: mp4/mkv</li>
                <li>Audio: mp3/wav</li>
                <li>Maks file: 3</li>
              </ul>
            </small>
          </div>
        </div>
        <div class="">
          <div class="float-left">
            <a href="{{ route('lecturer.index') }}" class="btn btn-secondary">Daftar materi</a>
          </div>
          <div class="text-right">
            <a href="" class="btn btn-default">Reset</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $('#inputfile1').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label1').innerHTML = fileName;
    });
    $('#inputfile2').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label2').innerHTML = fileName;
    });
    $('#inputfile3').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label3').innerHTML = fileName;
    });
  </script>
@endsection

