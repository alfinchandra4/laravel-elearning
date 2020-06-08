@extends('student.app')

@section('title', 'Chats')

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
  <h4 class="font-weight-bold mb-5">Mulai pesan </h4>
  <div class="search">
    <form action="{{ route('student.self.chat.search.process') }}" method="post">
      @csrf
      <div class="input-group mb-3">
        <input type="text" name="lecturer" id="lecturer" class="form-control form-control-lg" 
               placeholder="Masukkan nama dosen" value="{{old('lecturer')}}">
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit"> 
            <i class="fa fa-search" aria-hidden="true"></i> 
          </button>
        </div>
      </div>
    </form>
  </div>
  @if (session()->has('lecturers'))
    <div class="result col-md-6 offset-md-3">
      <h5 class="font-weight-lihter">Pencarian dosen</h5>
      <div class="list-group">
        @foreach (session('lecturers') as $lecturer)
        <a href="{{ route('sudent.self.chat.addnew.lecturer', $lecturer->id) }}"  onclick="return confirm('Buat pesan?')" class="list-group-item list-group-item-action" tabindex="-1" aria-disabled="true">
            {{ $lecturer->name }}
            <div class="float-right">
              <i class="fa fa-comment-o" aria-hidden="true"></i>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  @endif
@endsection