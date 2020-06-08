@extends('student.app')

@section('title', 'Kuis saya')

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
    <a href="{{ route('student.self.quizzes') }}" class="text-dark">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> Semua kuis saya
    <a/>
  </div>
  <h4 class="font-weight-bold ">Kuis</h4>
    <div class="row">
    <div class="col-md-9">
      <div class="alert alert-primary" role="alert">
      <div class="font-weight-bold">{{ $quiz->title }}</div>
       <details>
          <summary>Deskripsi</summary>
          {!! $quiz->description !!}
        </details> 
      </div>
      <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
          @php
              $totalCorrect = 0;
          @endphp
          @foreach (session('arrQuestionAnswers') as $data)
            @php
                $question = App\Question::find($data['question_id']);
            @endphp
            <div class="question font-weight-bold">{{ $loop->iteration }}. {{ $question->question }}</div>
            <div class="answers">
                <ol type="a">
                  @foreach ($question->choices as $choice)
                    @if (($choice->id == $data['answer_id']) && ($data['answer_id'] == $data['correct_id']))
                      @php $totalCorrect++; @endphp
                    @endif

                    @if ( ($choice->id == $data['answer_id']) && ($data['answer_id'] == $data['correct_id']) ||
                          ($choice->id == $data['correct_id']) && ($data['answer_id'] != $data['correct_id']))
                      <li class="text-success">
                        {{ $choice->choice }}
                      </li>
                    @elseif(($choice->id == $data['answer_id']) && ($data['answer_id'] != $data['correct_id']))
                      <li class="text-danger">
                        {{ $choice->choice }}
                      </li>
                    @else
                      <li>{{ $choice->choice }}</li>
                    @endif
                  @endforeach
                </ol>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body bg-primary text-white">
          <h4 class="card-title">Correct: </h4>
          <p class="card-text h1 font-weight-bold"> <i class="fa fa-check-circle" aria-hidden="true"></i>
             {{$totalCorrect}} of {{$questions->count()}}
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection

