@extends('layouts.app')

@section('title', 'Daily Report Class')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daily Report Class</h1>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        @foreach($class as $rowclass)
        <section class="col-4">
            <div class="card">
            <div class="card-header border-transparent modal-lg">
              <h3 class="card-title">"{{$rowclass->class_name}}" Class</h3><br>
              <h5 class="card-title">Wali Kelas : {{$rowclass->teacher_name}}</h5>
            </div>
              <div class="card-body p-0">
                <button class="btn btn-xs btn-success card-modal" data-toggle="modal" data-target="#modal-info" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Attendance</button> <button class="btn btn-xs btn-info detail-button" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Value</button>
                <br>
                <img src="{{asset('/picture/general/background.jpg')}}" style="width: 100%; height: 200px;">
              </div>
            </div>

        </section>
        @endforeach
        
      </div>
    </div>

    <div class="modal fade" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content bg-default">
          <div class="modal-header">
          <h4 class="modal-title">Daftar Siswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <form action="{{url('/class/absencestudents')}}" method="post">
            @csrf
          <div class="modal-body">
            <input type="date" name="date_absence" required>
                      <table id="students_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th style="width:5%">No</th>
                          <th>Nama Siswa</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>

          <button data-id="" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i>Submit</button>
          </div>

          </form>
        </div>

      </div>

    </div>
@endsection

@section('additionalscript')
<script>
  $(document).ready(function(){
    $('input[name="date_absence"]').attr('max', gettodaydate())
  });

  $('#modal-info').on('hidden.bs.modal', function(){
    $('input[name="date_absence"]').val('')
  })

  function gettodaydate(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today
  }

  $('.card-modal').on('click', function(){
    let id = $(this).attr("data-id")
    $('#students_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "{{url('/class/gridviewstudents')}}",
          data : {class_id : id},
          type : "POST",
          headers: {
             'X-CSRF-TOKEN': "{{csrf_token()}}",
          },
        },
        order: [[ 0, "asc" ]],
        searching:true,
        filter: true, 
        destroy: true,
        paging: false,
        columns: [
            {target: 0, data: 'DT_RowIndex',orderable: false, searchable: false},
            {target: 1, data: 'name'},
            {target: 2, data: 'student_action',},
        ],
        initComplete: function( settings, json ) {
          $('.student_absence_status').on('change', function(){
            let id = $(this).attr("data-id")
            $('#student_absence_description'+id+' option').remove()
            if($(this).val() == 'Hadir'){
              $('#student_absence_description'+id).append('<option value="Tepat Waktu">Tepat Waktu</option><option value="Terlambat">Terlambat</option><option value="Izin Setengah Hari">Izin Setengah Hari</option>')
            }else{
              $('#student_absence_description'+id).append('<option value="Izin">Izin</option><option value="Sakit">Sakit</option><option value="Tanpa Keterangan">Tanpa Keterangan</option>')
            }
          });
        }
    });
  });

  $('.detail-button').on('click', function(){
    let id = $(this).attr("data-id")
    window.open(
        "{{url('/class/detail')}}"+"/"+id,  
        '_blank', 
        'width=950,height=800,resizable=yes,screenx=0,screeny=0'
      );
  });


</script>
@endsection