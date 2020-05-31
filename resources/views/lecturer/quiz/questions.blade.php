@extends('lecturer.app')

@section('title', 'Detail kuis')

@section('css')
  <style>
      .card-header {
        border-bottom: 3px solid green;
      }
      .selected{
          color:green;
          font-weight: bold;
      }
  </style>
@endsection

@section('content')
@include('lecturer.quiz.navtabs')
    <div class="row ans-qw">
      <div class="col-md-6">
       <h4 class="font-weight-bold">Kuis</h4>
        <div class="card">
          <div class="card-body">
            <form action="{{ route('lecturer.quiz.question.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="question">Pertanyaan</label>
                <input type="text" name="question" id="question" class="form-control" placeholder="pertanyaan">
              </div>
              <div>
                @for ($i = 0; $i < 5; $i++)
                  <div class="input-group mb-1">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="radio" name="choices[]" value="{{$i}}"/>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Jawaban" name="answers[]"/>
                  </div> 
                @endfor
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h4 class="font-weight-bold">Pilihan ganda</h4>
        @foreach ($questions as $question)
          <div class="card mb-1">
            <div class="card-body pl-3 pb-0" style="padding: 5px">
              <div class="question">{{ $loop->iteration }}. {{ $question->question }}</div>
              <div class="answers">
                  <ol type="a">
                    @foreach ($question->choices as $choice)
                      @if ($choice->correct == 1)
                          <li class="selected"> {{ $choice->choice }}</li>
                      @else
                          <li> {{ $choice->choice }}</li>
                      @endif
                    @endforeach
                  </ol>
              </div>
            </div>
              <a href="{{ route('lecturer.quiz.question.delete', $question->id) }}" class="text-white btn btn-danger btn-block btn-sm" style="border-radius:0px"> Hapus</a>
          </div>                
        @endforeach
      </div>
@endsection
















