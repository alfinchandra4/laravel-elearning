@extends('lecturer.app')

@section('title', 'Edit assignment')

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
  <a href="{{ route('lecturer.assignment.index') }}">Semua assignment</a>
  <div class="card">
    <div class="card-header bg-warning">
      <div class="h5">Edit assignment</div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('lecturer.assignment.update') }}" id="edit_assignment">
        @csrf
        <input type="hidden" name="assignment_id" value={{ $assignment->id }}>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text" name="title" id="title" class="form-control" value="{{$assignment->title}}" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="date">Deadline</label>
                <input type="text" class="form-control" name="deadline" required id="datetime" value="{{$assignment->deadline}}">
              </div>
              <div class="form-group col-md-6">
                <label for="max_upload">Maximum file upload</label>
                <input type="number" class="form-control" id="max_upload" min="1" max="3" name="max_upload" required value="1" readonly>
                <small class="form-text text-muted">Maximum allowed content upload for student, min: 1 - max: 3</small>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" cols="30" rows="7" class="form-control">{{$assignment->description}}</textarea>
            </div>
          </div>
        </div>
      </form>
        <div>
          <div class="float-left">
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary" form="edit_assignment">Update</button>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    // https://www.daterangepicker.com/
  $(function() {
    $('input[name="deadline"]').daterangepicker({
        singleDatePicker: true,
        datePicker: false,
        timePicker: true,
        timePicker24Hour: true,
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      }
    });
  });
</script>
@endsection

