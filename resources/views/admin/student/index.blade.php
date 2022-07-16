@extends('layouts.app')

@section('title', 'Student')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student</h1>
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
                <table id="student_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:5%">No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Nomor Telepon</th>
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
    $('#student_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "{{url('/student/gridview')}}",
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
            {target: 1, data: 'photo'},
            {target: 2, data: 'name'},
            {target: 3, data: 'date_of_birth'},
            {target: 4, data: 'phone_number'},
            {target: 5, data: 'student_action'},
        ]
    });
  }

  function reloadDatatable() {
    $('#student_table').DataTable().ajax.reload(null, false);
  }

  $('#add').on('click', function(){
    window.open(
        "{{url('/student/create')}}", 
        '_blank', 
        'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('body').on('click', '#tombol_edit', function(){
    let id_edit = $(this).data("id")
    window.open(
      "{{url('/student/edit')}}"+"/"+id_edit, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

  $('body').on('click', '#tombol_hapus', function(){
    let id_hapus = $(this).data("id")
    window.open(
      "{{url('/student/delete')}}"+"/"+id_hapus, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

  $('body').on('click', '#tombol_detail', function(){
    let id_edit = $(this).data("id")
    window.open(
      "{{url('/student/show')}}"+"/"+id_edit+"/detail", 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

</script>
@endsection