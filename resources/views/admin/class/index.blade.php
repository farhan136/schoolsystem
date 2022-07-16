@extends('layouts.app')

@section('title', 'Class')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Class</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Menampilkan Daftar Kelas</h3> -->
                <button class="btn btn-xs btn-success" id="add"><i class="glyphicon glyphicon-edit"></i>Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="class_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Status Kelas</th>
                    <th style="width:10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('additionalscript')
<script>
  $(document).ready(function(){
    showData()
  });

  function showData(){
    $('#class_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "{{url('/class/gridview')}}",
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
            {target: 0, data: 'class_id'},
            {target: 1, data: 'class_name'},
            {target: 2, data: 'teacher_name'},
            {target: 3, data: 'class_status'},
            {target: 4, data: 'class_action'}
        ]
    });
  }

  function reloadDatatable() {
    $('#class_table').DataTable().ajax.reload(null, false);
  }

  $('#add').on('click', function(){
    window.open(
        "{{url('/class/create')}}", 
        '_blank', 
        'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('body').on('click', '#tombol_edit', function(){
    let id_edit = $(this).data("id")
    window.open(
      "{{url('/class/edit')}}"+"/"+id_edit, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

  $('body').on('click', '#tombol_hapus', function(){
    let id_hapus = $(this).data("id")
    window.open(
      "{{url('/class/delete')}}"+"/"+id_hapus, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

</script>
@endsection