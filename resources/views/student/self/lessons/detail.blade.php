@extends('student.app')

@section('title', 'Detail materi')

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
    <a href="{{ route('student.self.lesson.enrolled') }}" class="text-dark">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> Materi saya
    <a/>
  </div>
  <h4 class="font-weight-bold">Detail materi</h4>
  <div class="lesson">
    <h5>Materi</h5>
    <div class="font-weight-lighter mb-2">{{ $lesson->title }}</div>
    <h5>Deskripsi</h5>
    <div class="font-weight-lighter mb-2">{!! $lesson->description !!}</div>
    <h5>Files</h5>
    <div class="list-group">
      @foreach ($lesson_files as $file)
        @switch($file->format)
            @case('doc')
                @php
                    $url  = 'lessons/docs/'.$file->filename;
                    $icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
                @endphp
                @break
            @case('video')
                @php
                    $url  = 'lessons/videos/'.$file->filename;
                    $icon = '<i class="fa fa-file-video-o" aria-hidden="true"></i>';
                @endphp
                @break
            @case('audio')
                @php
                    $url  = 'lessons/audios/'.$file->filename;
                    $icon = '<i class="fa fa-file-audio-o" aria-hidden="true"></i>';
                @endphp
                @break
        @endswitch
        <a href="{{ Storage::url($url) }}" class="list-group-item list-group-item-action">{!!$icon!!} {{ $file->filename }}</a>
      @endforeach
    </div>
  </div>
@endsection

