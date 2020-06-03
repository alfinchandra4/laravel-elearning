@extends('lecturer.app')

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
    </style>
@endsection

@section('content')
  <div class="box">
    <div class="user-list">
      <div class="list-header bg-warning p-2 font-weight-bold">
        User list
      </div>
      <ul class="list-group list-group-flush list-body">
        @for ($i = 0; $i < 20; $i++)
          <li class="list-group-item list-group-item-action">Cras justo odio</li>
          <li class="list-group-item list-group-item-action">Dapibus ac facilisis in</li>
          <li class="list-group-item list-group-item-action">Morbi leo risus</li>
          <li class="list-group-item list-group-item-action">Porta ac consectetur ac</li>
          <li class="list-group-item list-group-item-action">Vestibulum at eros</li>
        @endfor
      </ul>
    </div>
    <div class="users-chat">
      <div class="list-header bg-warning p-2 font-weight-bold">
        Student.name
      </div>
      <div class="chats">
        <ul class="list-group list-group-flush chats-body">
          @for ($i = 0; $i < 20; $i++)
            <li class="list-group-item list-group-item-action">
              <div class="username text-muted">
                @if ($i % 2 == 0 )
                    Diana [15015012005 Sistem informasi]
                @else
                    Dosen Sri Kartike
                @endif
              </div>
              <div class="userchat">
                @if ($i % 2 == 0 )
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis, labore.
                @else
                    Lorem ipsum dolor sit amet consectetur.
                @endif
              </div>
              <div class="created-at text-muted" style="font-size: 10pt">
              13:25 29/05/20
              </div>
            </li>
          @endfor
        </ul>
      </div>
      <div class="chat-input" style="border-radius:0px">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button">Send</button>
          </div>
        </div>
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

