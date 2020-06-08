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
    <form action="{{ route('student.self.lecturer') }}" method="get">
      <div class="input-group mb-3">
        <input type="text" name="lecturer" id="lecturer" class="form-control form-control-lg" placeholder="Masukkan nama dosen" value="{{old('lecturer')}}">
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
        </div>
      </div>
    </form>
  </div>
  @if (session()->has('lecturers'))
    <div class="result col-md-6 offset-md-3">
      <h5 class="font-weight-lihter">Pencarian dosen</h5>
      <ul class="list-group unorderedlist">
        @foreach (session('lecturers') as $lecturer)
          <li class="list-group-item list-group-item-action float-left lecturer_list" data-lecturerid="{{$lecturer->id}}" data-toggle="modal" data-target="#exampleModal">
            <input type="hidden" id="lecturerid" value="{{$lecturer->id}}">
            {{ $lecturer->name }}
            <div class="float-right">
              <i class="fa fa-comment-o" aria-hidden="true"></i>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
@endsection

@section('modal')
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('student.self.chat.sendmsg') }}" method="post" id="create_msg_frm">
        @csrf
        <input type="hidden" name="lecturerid" id="getlecturerid">
        <div class="modal-body">
          <input type="text" name="message" class="form-control">
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" form="create_msg_frm" class="btn btn-primary btn-sm">Kirim pesan</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script>
      var ul_length = document.querySelector(".unorderedlist").children.length; // sum of li
      var ul = document.querySelector(".unorderedlist").children; // each li
      for (let index = 0; index < ul_length; index++) {
        list = ul[index]; // list
        list.addEventListener("click", function() {
          var lecturerid = this.dataset.lecturerid;
          console.log(lecturerid);
            document.getElementById('getlecturerid').value = lecturerid;
        })
      }
      
      
    </script>
@endsection
