@extends('lecturer.app')

@section('title', 'Tambah assignment')

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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>


tinymce.init({
  selector: 'textarea',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
  branding: false,
  resize: false
});


      </script>
@endsection

@section('content')
  <div class="card">
    <div class="card-header bg-warning">
      <div class="h5">Tambah assignment</div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('lecturer.assignment.store') }}" id="create_assignment">
        @csrf
        <input type="hidden" name="lecturer_id" value={{ auth()->guard('lecturer')->user()->id }}>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="date">Deadline</label>
                <input type="text" class="form-control" name="deadline" required id="datetime">
              </div>
              <div class="form-group col-md-6">
                <label for="max_upload">Maximum file upload</label>
                <input type="number" class="form-control" id="max_upload" min="1" max="3" name="max_upload">
                <small class="form-text text-muted">Maximum allowed content upload for student, min: 1 - max: 3</small>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" cols="30" rows="7" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </form>
        <div>
          <div class="float-left">
            <a href="{{ route('lecturer.assignment.index') }}" class="btn btn-secondary">Semua assignment</a>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary" form="create_assignment">Tambah</button>
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

