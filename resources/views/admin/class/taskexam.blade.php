@extends('layouts.app')

@section('title', 'Task Exam Class')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Task Exam Class</h1>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        @foreach($class as $rowclass)
        <section class="col-12">
            <div class="card">
            <div class="row">
               <div class="col-4">
                  <img src="{{asset('/picture/general/background.jpg')}}" style="width: 100%; height: 200px;"> 
               </div> 
               <div class="col-8">
                  <h3 class="card-title">Ulangan </h3><br>
                  <h5 class="card-title">Dibuat oleh : {{$rowclass->teacher_name}}</h5> 
                  <br>
                  <button class="btn btn-xs btn-success card-modal" data-toggle="modal" data-target="#modal-info" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Attendance</button> 
                  <button class="btn btn-xs btn-info detail-button" data-id="{{$rowclass->class_id}}"><i class="glyphicon glyphicon-edit"></i>Value</button>                
               </div>
            </div>
            <!-- <div class="card-header border-transparent modal-lg">

            </div>
              <div class="card-body p-0">
                
                <br>
                
              </div> -->
            </div>

        </section>
        @endforeach
        
      </div>
    </div>

@endsection

@section('additionalscript')
<script>
  $(document).ready(function(){
    // $('input[name="date_absence"]').attr('max', gettodaydate())
  });

  // $('#modal-info').on('hidden.bs.modal', function(){
  //   $('input[name="date_absence"]').val('')
  // })

  function gettodaydate(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    return today
  }




</script>
@endsection