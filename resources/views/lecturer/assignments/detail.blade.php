@extends('lecturer.app')

@section('title', 'Detail assignment')

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

@section('content-no-container')
  <div class="row">
    <div class="col-md-4">
      <span class="h5">Mahasiswa </span><span class="text-muted">(30)</span>
      <div class="list-group">
        @foreach ($students_assignment as $student_assignment)
          <a href="{{ route('lecturer.assignment.student.get', $student_assignment->id) }}" class="{{ $student_assignment->student->id == session('student_id') ? 'active' : '' }} list-group-item list-group-item-action float-left">
            {{ $student_assignment->student->name}}
            <div class="float-right">
              {{ date('d/m/Y H:i:s', strtotime($student_assignment->created_at)) }}
            </div>
          </a>
        @endforeach
      </div>
    </div>
    <div class="col-md-8">
    <h4>Assignment</h4>
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header bg-warning" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left text-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Assignment detail
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <h5>Assignment</h5>
                @php
                  $deadline = date('Y-m-d H:i:s', strtotime($assignment->deadline));
                  $today    = date('Y-m-d H:i:s');
                @endphp
                @if ($today <= $deadline)
                  <span class="badge badge-success">OPEN</span> 
                @else
                  <span class="badge badge-danger">CLOSED</span> 
                @endif
              <div class="text-muted">Judul</div>
              <div class="mb-2"> {{ $assignment->title }} </div>
              <div class="text-muted">Deskripsi</div>
              <div class="mb-2"> {!! $assignment->description !!} </div>
              <div class="text-muted">Deadline • {{ date('d/m/y H:i:s', strtotime($assignment->deadline))}}</div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-warning" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left text-dark font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Assignment answer
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            @if (session('answer_text'))
              <div class="card-body">
                <div class="font-weight-bold">Answer</div>
                <div class="fot-text">{!! session('answer_text') !!}</div>
                <ul class="list-group list-group-flush for-files">
                  <li class="list-group-item">File.doc</li>
                  <li class="list-group-item">Presentation.ppt</li>
                  <li class="list-group-item">VideoFunny.mp4</li>
                </ul>
              </div>
            @elseif (session('answer_files'))
              <div class="card-body">
                <div class="font-weight-bold">Answer</div>
                <div class="fot-text">Files</div>
                <ul class="list-group list-group-flush for-files">
                  @foreach (session('answer_files') as $file)
                    @switch($file->format)
                        @case('doc')
                            @php
                                $url  = 'assignments/docs/'.$file->filename;
                                $icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
                            @endphp
                            @break
                        @case('video')
                            @php
                                $url  = 'assignments/videos/'.$file->filename;
                                $icon = '<i class="fa fa-file-video-o" aria-hidden="true"></i>';
                            @endphp
                            @break
                        @case('audio')
                            @php
                                $url  = 'assignments/audios/'.$file->filename;
                                $icon = '<i class="fa fa-file-audio-o" aria-hidden="true"></i>';
                            @endphp
                            @break
                    @endswitch
                    <a href="{{ Storage::url($url) }}" class="list-group-item list-group-item-action">{!!$icon!!} {{ $file->filename }}</a>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection


