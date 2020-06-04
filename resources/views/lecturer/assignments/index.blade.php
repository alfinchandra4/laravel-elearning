@extends('lecturer.app')

@section('title', 'Assignments')

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
    <a href="{{ route('lecturer.assignment.create') }}">Tambah assignment</a> •
    <a href="{{ route('lecturer.assignment.index') }}" data-toggle="modal" data-target="#exampleModal" id="mymodal">Notifikasi</a> •  

    <div class="card">
      <div class="card-header bg-warning">
        <div class="h5">Assignment</div>
      </div>
      <div class="card-body">
        @php
          $assignments = App\Assignment::where('lecturer_id', lecturer()->id)->orderByDesc('created_at')->get();
        @endphp
            <table class="table table-hover table-striped table-hover" id="datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th style="width: 40%">Judul</th>
                  <th>Partisipan</th>
                  <th>Deadline</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($assignments as $ass)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ Str::words($ass->title, 6) }}</td>
                  <td>{{$ass->student_assignment->count()}} Mhs</td>
                  <td>
                      @php
                          $deadline = date('Y-m-d H:i:s', strtotime($ass->deadline));
                          $today    = date('Y-m-d H:i:s');
                      @endphp
                      @if ($today <= $deadline)
                      <span class="badge badge-success">OPEN {{ date('d/m/y H:i', strtotime($ass->deadline)) }}</span>
                      @else
                      <span class="badge badge-danger">CLOSED {{ date('d/m/y H:i', strtotime($ass->deadline)) }}</span>
                      @endif
                  </td>
                  <td>
                    <span class="badge badge-primary">
                      <a href="{{ route('lecturer.assignment.detail', $ass->id) }}" class="text-white">Detail</a>
                    </span>
                    <span class="badge badge-secondary">
                      <a href="{{ route('lecturer.assignment.edit', $ass->id) }}" class="text-white">Ubah</a>
                    </span>
                    <span class="badge badge-danger">Hapus</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
    </div>
@endsection

@section('modal')
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="h5">Notifikasi terbaru</div>
          @php
              $student_assignments = App\Studentassignment::whereIn('assignment_id', function($q) {
                $q->select('id')->from('assignments')->where('lecturer_id', lecturer()->id);
              })->orderByDesc('created_at')->get();
              // dd($student_assignments);
          @endphp
          <div class="list-group">
            @foreach ($student_assignments as $student_assignment)
              <a href="{{ route('lecturer.assignment.detail', $student_assignment->assignment->id) }}" class="list-group-item list-group-item-action">
                <div class="float-left">{{ Str::words($student_assignment->assignment->title, 6) }}</div>
                <div class="float-right font-weight-bold">{{ $student_assignment->student->name }}</div>
                <br/>
                <div class="float-right text-muted" style="font-size: 10pt"> {{ date('D, d/m/y H:i', strtotime($student_assignment->created_at))}} </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $("#mymodal").click(function(ev) {
        ev.preventDefault();
        var target = $(this).attr("href");
        console.log(target)

        // load the url and show modal on success
        $("#mymodal .modal-body").load(target, function() { 
            $("#mymodal").modal("show"); 
        });
    });
  </script>
@endsection

