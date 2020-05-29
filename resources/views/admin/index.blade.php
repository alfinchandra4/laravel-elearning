@extends('admin.app')

@section('title', 'Daftar mahasiswa')

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
  <div class="mb-1">
    @php
        $faculties = App\Faculty::all();
    @endphp
      <ul class="list-group list-group-horizontal list-group-horizontal-sm">
        <li class="list-group-item {{ session('faculty_id') == null ? 'list-group-item-warning' : '' }}">
          <a href="{{ route('admin.student.faculty') }}" class="text-dark">Semua fakultas</a>
        </li>
        @foreach ($faculties as $faculty)
          <li class="list-group-item {{ session('faculty_id') == $faculty->id ? 'list-group-item-warning' : '' }}">
            <a href="{{ route('admin.student.faculty', $faculty->id) }}" class="text-dark">{{ $faculty->name }}</a>
          </li>
        @endforeach
      </ul>
  </div>
  <div class="card">
    <div class="card-header bg-warning">
        <div class="h5 float-left">Daftar mahasiswa</div>
        <div class="float-right">
          <a href="#" data-toggle="modal" data-target="#add_new_student" class="text-dark"> Tambah mahasiswa </a>
        </div>
    </div>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-sm" style="width:100%">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Nim</th>
                  <th>Name</th>
                  <th>Fak</th>
                  <th>Jur</th>
                  <th>Ttl</th>
                  <th>Email</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody id="tbody" class="font-weight-lighter">
              @php
                  if(session('faculty_id') == null) {
                    $students = App\Student::all();
                  } else {
                    $selected_majors = App\Major::where('faculty_id', session('faculty_id'))->get();
                    $arr_selected_majors = [];
                    foreach ($selected_majors as $val) { $arr_selected_majors[] = $val->id; }
                    $students = App\Student::whereIn('major_id', $arr_selected_majors)->get();
                  }
              @endphp
              @foreach ($students as $student)
              @php
              @endphp
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nim }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->faculty->name }}</td>
                    <td>{{ $student->major->name }}</td>
                    <td>{{ $student->born }}, {{ date('d/m/y', strtotime($student->birth)) }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                      <a href="" data-toggle="modal" data-target="#modal_edit_student" data-studentid="{{ $student->id }}">Ubah</a>
                       - 
                      <a href="{{ route('admin.student.delete', $student->id) }}">Hapus</a>
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
  
    <!-- Modal for create-->
    <div class="modal fade" id="add_new_student" tabindex="-1" role="dialog" aria-labelledby="add_new_studentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="add_new_student">Tambah mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.student.store') }}" id="store_student_frm">
              @csrf
              <div class="form-group">
                <label for="nim">Nomor Induk Mahasiswa</label>
                <input type="text" id="nim" name="nim" class="form-control" maxlength="10" required>
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="faculty">Fakultas</label>
                <div class="input-group mb-3">
                  <select class="custom-select" name="faculty_id" id="faculty_id" required>
                    <option value="0">Pilih fakultas</option>
                    <option value="1">Ekonomi dan Bisnis</option>
                    <option value="2">Kedokteran</option>
                    <option value="3">Teknik</option>
                    <option value="4">Ilmu Sosial</option>
                    <option value="5">Ilmu Komputer</option>
                    <option value="6">Hukum</option>
                    <option value="7">Ilmu Kesehatan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="faculty">Jurusan</label>
                <div class="input-group mb-3">
                  <select class="custom-select" name="major_id" id="major_id" required> 
                    <option value="#"> Tidak tersedia </option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="born">Tempat lahir</label>
                <input type="text" class="form-control" id="born" name="born" required>
              </div>
              <div class="form-group">
                <label for="birth">Tanggal lahir</label>
                <input type="date" class="form-control" id="birth" name="birth" required>
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
            <button type="submit" form="store_student_frm" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for edit-->
    <div class="modal fade" id="modal_edit_student" tabindex="-1" role="dialog" aria-labelledby="modal_edit_studentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h5 class="modal-title" id="edit_student">Edit mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.student.update') }}" id="update_student_frm">
              @csrf
              <input type="hidden" name="studentid" id="studentid-edit">
              <div class="form-group">
                <label for="nim">Nomor Induk Mahasiswa</label>
                <input type="text" id="edit_nim" name="nim" class="form-control" maxlength="10" required readonly>
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="edit_name" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="faculty">Fakultas</label>
                <div class="input-group mb-3">
                  <select class="custom-select" name="faculty_id" id="edit_faculty_id" required>
                    <option value="0">Pilih fakultas</option>
                    <option value="1">Ekonomi dan Bisnis</option>
                    <option value="2">Kedokteran</option>
                    <option value="3">Teknik</option>
                    <option value="4">Ilmu Sosial</option>
                    <option value="5">Ilmu Komputer</option>
                    <option value="6">Hukum</option>
                    <option value="7">Ilmu Kesehatan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="faculty">Jurusan</label>
                <div class="input-group mb-3">
                  <select class="custom-select" name="major_id" id="edit_major_id" required> 
                    <option value="#"> Tidak tersedia </option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="born">Tempat lahir</label>
                <input type="text" class="form-control" id="edit_born" name="born" required>
              </div>
              <div class="form-group">
                <label for="birth">Tanggal lahir</label>
                <input type="date" class="form-control" id="edit_birth" name="birth" required>
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
            <button type="submit" form="update_student_frm" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
    <script>
      var faculty = document.querySelector('#faculty_id');
      faculty.addEventListener('change', function () {
        faculty_id = this.value;
          getMajor(faculty_id, '#major_id')
      });
    </script>

    <script>
      var tbody = document.getElementById('tbody');
      var edit_faculty_id = document.querySelector('#edit_faculty_id');
        var length = tbody.rows.length;
          for (var i = 0; i < length; i++) {
            // cell ke 7 children 0 utk mengarah kepada fungsi ubah
            var a = tbody.rows[i].cells[7].children[0];
            a.addEventListener('click', function (event) {
              event.preventDefault();
              var studentid = this.getAttribute('data-studentid');
              console.log(studentid);
              getStudent(studentid);
                edit_faculty_id.addEventListener('change', function () {
                  faculty_id = this.value;
                    getMajor(faculty_id, '#edit_major_id')
                })
            })
          }
    </script>

    <script>
      var getStudent = function(studentid) {
        var nim   = document.querySelector('#edit_nim');
        var name  = document.querySelector('#edit_name');
        var born  = document.querySelector('#edit_born');
        var birth = document.querySelector('#edit_birth');
        var email = document.querySelector('#edit_email');
        var stdid = document.querySelector('#studentid-edit');

        var value = '';
        var requestUrl = '/getstudent/' + studentid;
        var requestMethod = 'GET';
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) { 
              res = JSON.parse(this.responseText);
              console.log(res.student.nim)
              nim.value  = res.student.nim;
              name.value = res.student.name;
              born.value = res.student.born;
              birth.value= res.student.birth;
              email.value= res.student.email;
              stdid.value  = studentid;
            }
          }
          xhr.open(requestMethod, requestUrl);
          xhr.send();
      };

      var getMajor = function(faculty_id, targetTemperred) {
        var requestUrl = '/getmajor/' + faculty_id;
        var requestMethod = 'GET';
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              res = JSON.parse(this.responseText);
              obj_length = res.data.length;
              var options = '';
              if (obj_length !== 0) {
                for (let index = 0; index < obj_length; index++) {
                  options += "<option value="+ res.data[index].id +">"+ res.data[index].name +"</option>";
                }                
              } else {
                options = "<option> Tidak tersedia </option>";
              }
                document.querySelector(targetTemperred).innerHTML = options;
            }
          }
          xhr.open(requestMethod, requestUrl);
          xhr.send();
      };
    </script>
@endsection

