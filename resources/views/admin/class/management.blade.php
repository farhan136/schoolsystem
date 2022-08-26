@extends('layouts.app')

@section('title', 'Class')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Class Management</h1>
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
                <button class="btn btn-xs btn-warning card-modal" data-toggle="modal" data-target="#modal-info" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Show Students</button> <button class="btn btn-xs btn-info detail-button" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Show Details</button><!-- <button class="btn btn-xs btn-warning card-modal" data-toggle="modal" data-target="#modal-info" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Export</button> -->
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
          <div class="modal-body">
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
          </div>
          
        </div>

      </div>

    </div>
@endsection

@section('additionalscript')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script>
  $(document).ready(function(){
    
  });

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
        lengthMenu: [
          [10, 50, 100, -1], 
          ["10 DATA", "50 DATA", "100 DATA", "ALL"]
        ],
        columns: [
            {target: 0, data: 'DT_RowIndex',orderable: false, searchable: false},
            {target: 1, data: 'name'},
            {target: 2, data: 'student_id', visible:false},
        ],
        dom: 'Bfrtip',
        buttons: [
            'print', 'copy', 'pdf', 'excel'
           ],
          language: {
              buttons: {
                  print: 'Print',
                  copy: 'Copy',
                  excel: 'Excel',
                  pdf: 'Pdf'
               }
           },
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