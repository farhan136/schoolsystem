@extends('layouts.form')

@section('title', 'Create Class')

@section('additionalstyle')
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
              <h3 class="card-title">Create Class</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/class/store')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputname">Nama Kelas</label>
                    <input type="text" name="name" class="form-control" id="inputname" placeholder="Enter name" autocomplete="off">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Wali Kelas</label>
                    <select class="form-control select2" style="width: 100%;" name="teacher" autocomplete="off" id="teacher">
                      <option value="" selected></option>
                      @foreach($employee as $emp)
                      <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                      @endforeach
                    </select>
                    @error('teacher')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
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
<script type="text/javascript">
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
  });

  $('#teacher').on('change', function(){
    let teacher_id = $('#teacher').val()
    $.ajax({
      url : "{{url('/class/checkuniqueteacher')}}",
      type : 'post',
      headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
      },
      data : {'id': teacher_id},
      success: function(ret) {
          data = JSON.parse(ret);
          if(data == 'tidak unik'){
            Swal.fire('Guru yang kamu pilih sudah menjadi wali kelas di kelas lain')
            $('#teacher').val('')
          }
          }
        })
      });
</script>
@endsection