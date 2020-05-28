@extends('lecturer.app')

@section('title', 'Ubah materi')

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
      <div class="h5">Ubah materi</div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('lecturer.lesson.update') }}" enctype="multipart/form-data" id="myform">@csrf</form>
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}" form="myform"/>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text" name="title" id="title" class="form-control" required value="{{ $lesson->title }}" form="myform">
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize: none" required form="myform">{{ $lesson->description }}</textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="file">Upload file</label>
              <div class="files">
                <div class="input-group mb-3">
                  <form action="{{ route('lecturer.lessons.files.store') }}" method="post" id="addFileFrm" enctype="multipart/form-data"> @csrf </form>
                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}" form="addFileFrm"/>
                    <div class="custom-file">
                      <input type="file" {{ $lesson_files->count() > 2 ? 'disabled' : '' }} class="custom-file-input custom-file-input-sm inputfile" name="file" form="addFileFrm" required>
                      <label class="custom-file-label file-label">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" form="addFileFrm" type="submit">Upload</button>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                @foreach ($lesson_files as $file)
                  @switch($file->format)
                      @case('doc')
                          @php
                              $url = 'lessons/docs/'.$file->filename
                          @endphp
                          @break
                      @case('video')
                          @php
                              $url = 'lessons/videos/'.$file->filename
                          @endphp
                          @break
                      @case('audio')
                          @php
                              $url = 'lessons/audios/'.$file->filename
                          @endphp
                          @break
                  @endswitch
                  <li class="list-group-item list-group-item-secondary float-left">
                    <a href="{{ Storage::url($url) }}">{{ $file->filename }}</a>
                    <div class="float-right text-danger font-weight-bold">
                      <a href="{{ route('lecturer.lessons.files.delete', $file->id) }}" class="btn btn-sm btn-danger">X</a>
                    </div>
                  </li>
                @endforeach
                </ul>
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
            <button type="submit" class="btn btn-primary" form="myform">Update</button>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $('.inputfile').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label').innerHTML = fileName;
    });
  </script>
@endsection

