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
    <a href="{{ route('student.public.assignments') }}" class="text-dark">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> Semua assignment
    <a/>
  </div>
  <h4 class="font-weight-bold ">Assignments</h4>
  @php
      $deadline = date('Y-m-d H:i:s', strtotime($assignment->deadline));
      $today    = date('Y-m-d H:i:s');
  @endphp
  @if ($today <= $deadline)
    <h5 class="badge btn-success" style="font-size: 10pt">
      OPEN ᛫ {{ date('d/m/y H:i:s' ,strtotime($deadline)) }}</> 
    </h5>
  @else
    <h5 class="badge btn-danger" style="font-size: 10pt">
      CLOSED ᛫ {{ date('d/m/y H:i:s' ,strtotime($deadline)) }}</> 
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
  <div class="form-group">
    <select name="model" id="model" class="form-control col-md-4 mb-2" {{ date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($assignment->deadline)) ? '' : 'disabled' }}>
      <option value="0">Model jawab</option>
      <option value="1">Text</option>
      <option value="2">Files</option>
    </select>
    <div id="output">
      <div class="answer-text" style="display: none">
        <form action="{{ route('student.public.assignment.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <textarea name="answer_text" cols="30" rows="10" style="height: 300px" class="mb-2"></textarea>
          <div class="mt-2">
            <input type="hidden" name="model" id="model_text">
            <input type="hidden" name="assignment_id" id="assignment_id" value="{{ $assignment->id }}">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
      <div class="answer-files" style="display: none">
        <form action="{{ route('student.public.assignment.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          @for ($i = 0; $i < $assignment->max_upload; $i++)
            <div class="input-group mb-1 col-md-4">
              <div class="custom-file">
                <input type="file" class="custom-file-input custom-file-input-sm" id="inputfile{{$i}}" name="file[]">
                <label class="custom-file-label file-label{{$i}}">Choose file</label>
              </div>
            </div>
          @endfor
          <small class="text-muted mt-2">
            Format yang diperbolehkan
            <ul>
              <li>Dokumen: doc/docx/pdf</li>
              <li>Video: mp4/mkv</li>
              <li>Audio: mp3/wav</li>
            </ul>
          <div class="mt-2">
            <input type="hidden" name="model" id="model_files">
            <input type="hidden" name="assignment_id" id="assignment_id" value="{{ $assignment->id }}">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
      <small class="no-answer text-muted" style="display: none">Please choose answer mode</small>
    </div>
  </div>
@endsection

@section('js')
    <script>
      var answerText  = document.querySelector(".answer-text");
      var answerFiles = document.querySelector(".answer-files");
      var noAnswer    = document.querySelector(".no-answer");
      var modelText = document.querySelector("#model_text");
      var modelFiles = document.querySelector("#model_files");

      noAnswer.style.display = 'block';

      var select = document.querySelector("#model").addEventListener('change', function() {
        answerText.style.display = 'none';
        answerFiles.style.display = 'none';
        noAnswer.style.display = 'none';
        option_value = this.value;
          if (option_value == 1) {
            answerText.style.display = 'block';
            modelText.value = option_value;
          } else if(option_value == 2) {
            answerFiles.style.display = 'block';
            modelFiles.value = option_value;
          } else {
            noAnswer.style.display = 'block';
          }
      });
    </script>

    <script>
    $('#inputfile0').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label0').innerHTML = fileName;
    });
    $('#inputfile1').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label1').innerHTML = fileName;
    });
    $('#inputfile2').on('change',function(){
        var fileName = $(this)[0].files[0].name;
        document.querySelector('.file-label2').innerHTML = fileName;
    });
    </script>
@endsection

