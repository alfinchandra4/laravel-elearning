@extends('student.app')

@section('title', 'Detail assignment')

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
  <div class="alert alert-danger" role="alert">
    <a href="{{ route('student.self.assignments') }}" class="text-dark">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> Semua assignment saya
    <a/>
  </div>
  <h4 class="font-weight-bold ">Assignments</h4>
  @php
      $deadline = date('Y-m-d H:i:s', strtotime($assignment->deadline));
      $today    = date('Y-m-d H:i:s');
  @endphp
  @if ($today <= $deadline)
    <h5 class="badge btn-success" style="font-size: 12pt">
      OPEN ᛫ {{ date('d/m/y H:i:s', strtotime($deadline)) }}
    </h5>
  @else
    <h5 class="badge btn-danger" style="font-size: 12pt">
      CLOSED ᛫ {{ date('d/m/y H:i:s', strtotime($deadline)) }}
    </h5>
  @endif

  <div class="assignment">
  <div class="font-weight-lighter mb-2">Pengajar: {{ $assignment->lecturer->name }}</div>
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title">{{ $assignment->title }}</h4>
        <p class="card-text">{!! $assignment->description !!}</p>
      </div>
    </div>
  <h5>Kirim jawaban</h5> 

  @isset ($student_assignment_text) 
    @if ($today <= $deadline)
      <form action="{{ route('student.self.assignment.update.text') }}" method="post">
        @csrf
        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
        <input type="hidden" name="student_assignment_id" value="{{ $student_assignment_id }}">
        <textarea name="text" id="text" cols="30" rows="7" class="form-control">{!! $student_assignment_text->text !!}</textarea>
        <button type="submit" class="btn btn-primary mt-2">Perbarui</button>
      </form>
    @else
      <div class="card">
        <div class="card-body">
          {!! $student_assignment_text->text !!}
        </div>
      </div> 
    @endif 
  @endisset

  @if (!$student_assignment_files->isEmpty())
    @php
      $assignment = App\Assignment::find($assignment_id);
      $max_upload = $assignment->max_upload;
    @endphp
    <div class="form-group">
      @if ($today <= $deadline)
      <label for="file">Upload file</label>
      <div class="files">
          <div class="input-group mb-3">
            <form action="{{ route('student.self.assignment.update.files') }}" method="post" id="addFileFrm" enctype="multipart/form-data"> @csrf </form>
            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}" form="addFileFrm">
            <input type="hidden" name="student_assignment_id" value="{{ $student_assignment_id }}" form="addFileFrm">
            <div class="custom-file">
              <input type="file" {{ $student_assignment_files->count() >= $max_upload ? 'disabled' : '' }} class="custom-file-input custom-file-input-sm inputfile" name="file" form="addFileFrm" required>
              <label class="custom-file-label file-label">Choose file</label>
            </div>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" form="addFileFrm" type="submit">Upload</button>
            </div>
          </div>
        @endif
        <ul class="list-group list-group-flush">
          @foreach ($student_assignment_files as $file)
            @switch($file->format)
                @case('doc') @php   $url = 'assignments/docs/'.$file->filename @endphp @break
                @case('video') @php $url = 'assignments/videos/'.$file->filename @endphp @break
                @case('audio') @php $url = 'assignments/audios/'.$file->filename @endphp @break
            @endswitch
            <li class="list-group-item list-group-item-secondary float-left">
              <a href="{{ Storage::url($url) }}">{{ $file->filename }}</a>
                @if ($today <= $deadline)
                  <div class="float-right text-danger font-weight-bold">
                    <a href="{{ route('student.assignment.files.delete', $file->id) }}" class="btn btn-sm btn-danger">X</a>
                  </div>
                @endif
            </li>
          @endforeach  
        </ul>
      </div>
    </div>
  @endif
@endsection

@section('js')
    <script>
      $('.inputfile').on('change',function(){
          var fileName = $(this)[0].files[0].name;
          document.querySelector('.file-label').innerHTML = fileName;
      });
    </script>
@endsection

