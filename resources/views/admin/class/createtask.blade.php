@extends('layouts.form')

@section('title', 'Create Class')

@section('additionalstyle')
<!-- button datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<style>
    .content-wrapper {background-color:#0260f7 !important;}
    .card{
      margin-top: 40px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Create Task</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/class/storetask')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Pelajaran</label>
                    <select class="form-control select2" style="width: 100%;" name="subject" autocomplete="off" id="subject">
                      <option value="" selected></option>
                      @foreach($subjects as $sub)
                      <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nama Kelas</label>
                    <select class="form-control select2" style="width: 100%;" name="class" autocomplete="off" id="class">
                      <option value="" selected></option>
                      @foreach($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="startdate" class="form-control select2" style="width: 100%;">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="enddate" class="form-control select2" style="width: 100%;">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Pilih Level</label>
                    <select class="form-control select2" style="width: 100%;" name="level" autocomplete="off" id="level">
                      <option value="" selected></option>
                      @for($x=1; $x<=10; $x++)
                      <option value="{{$x}}">{{$x}}</option>
                      @endfor
                    </select>
                  </div>
                  <div class="form-group" id="divtable">
                    <table id="question_table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style="width:5%">Pilih</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban Benar</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('additionalscript')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#divtable').hide()
  });

  $('#subject, #level').on('change', function(){
    if($('#subject').val() != '' && $('#level').val() != ''){
      $('#divtable').show()
      showData()
    }
  })
  
  function showData(){
    // alert("tes")
    let subject = $('#subject').val()
    let level = $('#level').val()
    $('#question_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "{{url('/class/gridviewquestion')}}",
          type : "POST",
          data:{
            'subject':subject,
            'level':level
          },
          headers: {
             'X-CSRF-TOKEN': "{{csrf_token()}}",
          },
        },
        order: [[ 0, "asc" ]],
        searching:true,
        filter: true, 
        destroy: true,
        lengthMenu: [
          [10, 50, 100, -1], 
          ["10 DATA", "50 DATA", "100 DATA", "ALL"]
        ],
        columns: [
            {target: 0, data: 'action'},
            {target: 1, data: 'question'},
            {target: 2, data: 'true_answer'}
        ]
    });
  }
  
</script>
@endsection