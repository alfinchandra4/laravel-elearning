 @extends('student.app')

@section('title', 'Live chat')

@section('css')
    <style>
      .box {
        min-height: 550px;
        width: 100%;
        border-radius: 5px;
      }
      .user-list {
        float: left;
        width: 40%;
        border-right: 2px solid gray;
        min-height: 540px;
        background-color: white;
      }
      .users-chat {
        float: right;
        width: 60%;
      }
      .list-body {
        overflow: scroll;
        height: 500px;
        overflow-x: hidden;
      }
      .chats-body {
        overflow: scroll;
        height: 450px;
        overflow-x: hidden;
      }
      .chats {
        min-height: 467px;
        background-color: white;
      }
      .listlecturer .list-group-item{
          border-top-right-radius: 0px !important;
          border-top-left-radius: 0px !important;
          border-bottom-right-radius: 0px !important;
          border-bottom-left-radius: 0px !important;
      }
    </style>
@endsection

@section('content')

  <div class="box">
    <div class="user-list">
      <div class="list-header bg-warning p-2">
        <a href="{{ route('student.self.chat.search.lecturer') }}" class="text-dark"> 
          <i class="fa fa-search" aria-hidden="true"></i> 
          Cari dosen 
        </a>
      </div>
      <div class="list-group listlecturer">
        @php
            $chatrooms = App\Chatsroom::where('student_id', student()->id)
                                ->orderByDesc('created_at')->get();
        @endphp
        @foreach ($chatrooms as $chatroom)
          <a href="{{ route('student.self.chat.selected.lecturer', $chatroom->lecturer_id) }}" 
             class="list-group-item list-group-item-action {{ $chatroom->lecturer_id == session('lecturerid') ? 'active' : '' }}" tabindex="-1" aria-disabled="true">
            {{ $chatroom->lecturer->name }}
            <div class="float-right">
              <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </div>
          </a>
        @endforeach
      </div>
    </div>
    <div class="users-chat">
      <div class="list-header bg-warning p-2 font-weight-bold" style="height: 40px"></div>
      <div class="chats">
        @if (session()->has('user_chats'))
          <ul class="list-group list-group-flush chats-body">
            @foreach (session('user_chats') as $chat)
              <li class="list-group-item list-group-item-action">
                <div class="username text-muted font-weight-bold"> {{ $chat->name }} </div>
                <div class="userchat font-weight-lighter"> {{ $chat->message }} </div>
                <div class="created-at text-muted font-weight-lighter" style="font-size: 8pt">
                {{ date('H:i d/m/y', strtotime($chat->created_at)) }}
                </div>
              </li>
            @endforeach            
          </ul>
        @endif
      </div>
      <div class="chat-input" style="border-radius:0px">
        <form action="{{ route('student.self.chat.sendmsg') }}" method="post">
          @csrf
          <input type="hidden" name="lecturerid" value="{{ session('lecturerid') }}">
          <input type="hidden" name="chatroomid" value="{{ session('chatroomid') }}">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tulis pesan" name="message">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="submit">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function(){
        $('.chats-body').animate({
            scrollTop: $('.chats-body')[0].scrollHeight});
    });
  </script>
@endsection

