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
      OPEN ᛫ {{ $deadline }}
    </h5>
  @else
    <h5 class="badge btn-danger" style="font-size: 12pt">
      CLOSED ᛫ {{ $deadline }}
    </h5>
  @endif

  <div class="assignment">
  <h5>Pengajar</h5>
  <div class="font-weight-lighter mb-2">{{ $assignment->lecturer->name }}</div>
  <h5>Judul</h5>
  <div class="font-weight-lighter mb-2">{{ $assignment->title }}</div>
  <h5>Deskripsi</h5>
  <div class="font-weight-lighter">{!! $assignment->description !!}</div>
  <h5>Kirim jawaban</h5> 
  @if ($today <= $deadline)
    {{-- <a href="">Edit jawaban</a>     --}}
      @if ($student_assignment_text !== null) 
        <form action="{{ route('student.self.assignment.update.text') }}" method="post">
          @csrf
          <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
          <input type="hidden" name="student_assignment_id" value="{{ $student_assignment_id }}">
          <textarea name="text" id="text" cols="30" rows="7" class="form-control">{!! $student_assignment_text->text !!}</textarea>
          <button type="submit" class="btn btn-primary mt-2">Perbarui</button>
        </form>
      @endif
  @else
    <div class="card">
      <div class="card-body">
        {!! $student_assignment_text->text !!}
      </div>
    </div>  
  @endif

  @if ($student_assignment_files !== null)
      
  @endif
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

