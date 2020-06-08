 @extends('student.app')

@section('title', 'Profile')

@section('css')
@endsection

@section('content')
 <div class="card col-md-6 offset-md-3">
   <div class="card-body">
     <h4 class="card-title">Profile</h4>
      @php
          $student = App\Student::find(student()->id);
      @endphp
        <ul class="list-group list-group-flush">
          <li class="list-group-item float-left">Nama <div class="float-right font-weight-bold">{{ $student->name }}</div></li>
          <li class="list-group-item float-left">NIM  <div class="float-right font-weight-bold">{{ $student->nim }}</div></li>
          <li class="list-group-item float-left">Email  <div class="float-right font-weight-bold">{{ $student->email }}</div></li>
          <li class="list-group-item float-left">Kata sandi <a href="#" data-toggle="modal" data-target="#exampleModal">Ubah</a>
              <div class="float-right font-weight-bold">{{ Str::limit($student->password, 30, $end='...') }}</div></li>
          <li class="list-group-item float-left">Fakultas <div class="float-right font-weight-bold">{{ $student->faculty->name }}</div></li>
          <li class="list-group-item float-left">Jurusan <div class="float-right font-weight-bold"> {{ $student->major->name }}</div></li>
          <li class="list-group-item float-left">Tempat, tanggal lahir <div class="float-right font-weight-bold">{{ $student->born }}, {{ date('d/m/y', strtotime($student->birth)) }}</div></li>
        </ul>
   </div>
 </div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('student.setpassword') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection

