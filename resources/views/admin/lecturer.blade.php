@extends('admin.app')

@section('title', 'Dosen')

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

@section('content')
  <a href="#" data-toggle="modal" data-target="#add_new_lecturer"> Tambah dosen </a>
  <div class="card">
    <div class="card-header bg-warning">
        <div class="h5 float-left">Daftar dosen</div>
        {{-- <div class="float-right">
          <a href="#" data-toggle="modal" data-target="#add_new_lecturer"> Tambah dosen </a>
        </div> --}}
    </div>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-sm" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nidn</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody id="tbody" class="font-weight-lighter">
            @php
                $lecturers = App\Lecturer::orderByDesc('updated_at')->get();
            @endphp
            @foreach ($lecturers as $lecturer)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $lecturer->nidn }}</td>
                  <td>{{ $lecturer->name }}</td>
                  <td>{{ $lecturer->email }}</td>
                  <td>
                    <a href="" data-toggle="modal" data-target="#modal_edit_lecturer" data-lecturerid="{{ $lecturer->id }}">Ubah</a>
                    <a href="{{ route('admin.lecturer.delete', $lecturer->id) }}">Hapus</a>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div>
  
    <!-- Modal for create-->
    <div class="modal fade" id="add_new_lecturer" tabindex="-1" role="dialog" aria-labelledby="add_new_lecturerLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="add_new_lecturer">Tambah dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.lecturer.store') }}" id="store_lecturer_frm">
              @csrf
              <div class="form-group">
                <label for="nidn">Nomor Induk Dosen</label>
                <input type="text" id="nidn" name="nidn" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            <button type="submit" form="store_lecturer_frm" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for edit-->
    <div class="modal fade" id="modal_edit_lecturer" tabindex="-1" role="dialog" aria-labelledby="modal_edit_lecturerLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="modal_edit_lecturer">Ubah dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.lecturer.update') }}" id="update_lecturer_frm">
              @csrf
              <input type="hidden" name="lecturerid" id="edit_lecturerid">
              <div class="form-group">
                <label for="nidn">Nomor Induk Dosen</label>
                <input type="text" id="edit_nidn" name="nidn" class="form-control" required readonly>
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="edit_name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="edit_email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="edit_password" name="password">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            <button type="submit" form="update_lecturer_frm" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
    <script>
      var tbody = document.getElementById('tbody');
      var edit_faculty_id = document.querySelector('#edit_faculty_id');
        var length = tbody.rows.length;
          for (var i = 0; i < length; i++) {
            // cell ke 7 children 0 utk mengarah kepada fungsi ubah
            var a = tbody.rows[i].cells[4].children[0];
            a.addEventListener('click', function (event) {
              event.preventDefault();
              var lecturerid = this.getAttribute('data-lecturerid');
              getlecturer(lecturerid)
            })
          }
    </script>

    <script>
      var getlecturer = function(studentid) {
        var nidn     = document.querySelector('#edit_nidn');
        var name     = document.querySelector('#edit_name');
        var email    = document.querySelector('#edit_email');
        var lecturerid = document.querySelector('#edit_lecturerid');

        var value = '';
        var requestUrl = '/getlecturer/' + studentid;
        var requestMethod = 'GET';
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) { 
              res = JSON.parse(this.responseText);
              console.log(res.lecturer.nidn)
              nidn.value       = res.lecturer.nidn;
              name.value       = res.lecturer.name;
              email.value      = res.lecturer.email;
              lecturerid.value = res.lecturer.id;
            }
          }
          xhr.open(requestMethod, requestUrl);
          xhr.send();
      };
    </script>
@endsection

