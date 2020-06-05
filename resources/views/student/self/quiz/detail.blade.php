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
          @foreach (session('arrQuestionAnswers') as $data)
            @php
                $question = App\Question::find($data['question_id']);
            @endphp
            <div class="question font-weight-bold">{{ $loop->iteration }}. {{ $question->question }}</div>
            <div class="answers">
                <ol type="a">
                  @foreach ($question->choices as $choice)
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
          {{-- @foreach ($questions as $question)
            <div class="question">{{ $loop->iteration }}. {{ $question->question }}</div>
            <div class="answers">
                <ol type="a">
                  @foreach ($question->choices as $choice)
                    <li class="text-danger">
                      {{ $choice->choice }}
                    </li>
                  @endforeach
                </ol>
            </div>
          @endforeach --}}
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body bg-primary text-white">
          <h4 class="card-title">Result: </h4>
          <p class="card-text h1 font-weight-bold"> <i class="fa fa-check-circle" aria-hidden="true"></i> 8 of 10</p>
        </div>
      </div>
    </div>
  </div>
@endsection

