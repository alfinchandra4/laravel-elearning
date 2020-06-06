@extends('lecturer.app')

@section('title', 'Detail kuis')

@section('css')
<style>
  .card-header {
    border-bottom: 3px solid green;
  }
  .question-choice{
    color:green;
    font-weight: bold;
  }
  .student-choice{
    color:red;
    font-weight: bold;
  }
</style>
@endsection

@section('content')
@include('lecturer.quiz.navtabs')
<div class="row">
  <div class="col-md-5">
    <h4 class="font-weight-bold">Mahasiswa</h4>
    <div class="list-group">
      @php
        $student_quizzes = App\Studentquiz::where('quiz_id', $quiz_id)->orderByDesc('created_at')->get();
      @endphp
      @foreach ($student_quizzes as $stdquiz)
        <a href="{{ route('lecturer.quiz.student.selected', [$quiz_id, $stdquiz->student_id]) }}" 
          class="list-group-item list-group-item-action float-left {{ $stdquiz->student_id == session('student')['id'] ? 'active' : '' }}">
          {{$stdquiz->student->name}}
          <div class="float-right"> 
            {{ date('D, d/m/y H:i:s', strtotime($stdquiz->created_at)) }}
          </div>
        </a>
      @endforeach
    </div>
  </div>
  <div class="col-md-7">
    <h4 class="font-weight-bold">Jawaban</h4>
    <div class="alert alert-info" role="alert"> 
      @if (session()->has('student'))
          <b>{{ session('student')['name']}}</b>, Result: {{ session('student')['score'] }} 
      @endif
    </div>
    @if (session()->has('student_choices'))
      @foreach (session('student_choices') as $student_choice)
      @php
          $question = App\Question::find($student_choice->question_id);
      @endphp
          <div class="card mb-1">
            <div class="card-body pl-3 pb-0" style="padding: 5px">
              <div class="question font-weight-bold">{{ $loop->iteration }}. {{ $question->question}}</div>
              <div class="answers">
                <ol type="a">
                  @foreach ($question->choices as $choice)
                    @if (($choice->id == $student_choice->choice_id) && ($choice->correct == 1) || 
                         ($choice->id != $student_choice->choice_id) && ($choice->correct == 1))
                      <li class="text-success"> {{ $choice->choice }} </li>
                    @elseif (($choice->id == $student_choice->choice_id) && ($choice->correct != 1))
                      <li class="text-danger"> {{ $choice->choice }} </li>
                    @else
                      <li> {{ $choice->choice }} </li>
                    @endif
                  @endforeach
                </ol>
              </div>
            </div>
          </div> 
      @endforeach
    @endif
  </div>
</div>
@endsection
















