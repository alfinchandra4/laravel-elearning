@extends('student.app')

@section('title', 'Mulai kuis')

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
  <div class="offset-md-2 col-md-8">
    <div class="alert alert-danger" role="alert">
      <a href="{{ route('student.public.quizzes') }}" class="text-dark">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Semua kuis
      <a/>
    </div>
    <h4 class="font-weight-bold ">Kuis</h4>
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title">{{ $quiz->title }}</h4>
        <p class="card-text">{!! $quiz->description !!}</p>
      </div>
    </div>
    <div class="card" style="width: 100%">
      <div class="card-body">
        <form action="{{ route('student.public.quizzes.answer') }}" method="post" id="quizFrm">
          @csrf
          <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
          @foreach ($questions as $question)
            <div class="question">{{ $loop->iteration }}. {{ $question->question }}</div>
            <div class="answers">
                <ol type="a">
                  @foreach ($question->choices as $choice)
                      <li>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="q[{{$question->id}}]" id="q{{$choice->id}}" value="{{$choice->id}}">
                        <label class="form-check-label" for="q{{$choice->id}}"> {{ $choice->choice }} </label>
                      </div>
                    </li>
                  @endforeach
                </ol>
            </div>
          @endforeach
        </form>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Are your sure ?')" form="quizFrm">Jawab</button>
      </div>
    </div>
  </div>
@endsection

