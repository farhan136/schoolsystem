@extends('layouts.form')

@section('title', 'Create Employee')

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
              <h3 class="card-title">Create New Employee</h3>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/employee/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" id="inputname" placeholder="Enter name" autocomplete="off" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="inputemail" placeholder="Enter email" autocomplete="off" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" name="number" class="form-control" id="inputnumber" placeholder="Enter number" autocomplete="off" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select class="form-control select2" style="width: 100%;" name="marital" autocomplete="off" required>
                      <option value="Single" selected>Single</option>
                      <option value="Married">Married</option>
                      <option value="Widow">Widow</option>
                    </select>
                    @error('marital')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" style="width: 100%;" name="gender" autocomplete="off" required>
                      <option value="Male" selected>Male</option>
                      <option value="Female">Female</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" placeholder="Enter date" autocomplete="off" required>
                    @error('dateofbirth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Place Of Birth</label>
                    <select class="form-control select2" style="width: 100%;" name="placeofbirth" autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($cities as $city)
                      <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                      @endforeach
                    </select>
                    @error('placeofbirth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Province</label>
                    <select class="form-control select2" style="width: 100%;" name="province" id="province" autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($provinces as $province)
                      <option value="{{ $province->prov_id }}">{{ $province->prov_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control select2" style="width: 100%;" name="city" id="city" autocomplete="off" required>
                      <option value="" selected></option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>District</label>
                    <select class="form-control select2" style="width: 100%;" name="district" id="district" autocomplete="off" required>
                      <option value="" selected></option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subdistrict</label>
                    <select class="form-control select2" style="width: 100%;" name="subdistrict" id="subdistrict" autocomplete="off" required>
                      <option value="" selected></option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control select2" style="width: 100%;" name="role" id="role" autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($role as $rowrole)
                        @if($rowrole->code == 99)
                          <option value="{{ $rowrole->code }}">{{ $rowrole->name }}</option>
                        @else
                          <option value="{{ $rowrole->code }}">Guru {{ $rowrole->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Enter address" autocomplete="off" required rows="5"></textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                   <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control" placeholder="Enter date" autocomplete="off" required>
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('teacher')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

    $('#province').on('change', function(){
    let province_id = $('#province').val()
    $.ajax({
      url : "{{url('/getcity')}}",
      type : 'post',
      headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
      },
      data : {'id': province_id},
      success: function(ret) { 
          // console.log(ret);
          data = JSON.parse(ret);
          console.log(data)
          $.each(data, function (key, item) {
              $('#city').append($('<option>', { 
                  value: item.city_id,
                  text : item.city_name 
              }));
          });
          }
        })
      });

    $('#city').on('change', function(){
    let city_id = $('#city').val()
    $.ajax({
      url : "{{url('/getdistrict')}}",
      type : 'post',
      headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
      },
      data : {'id': city_id},
      success: function(ret) { 
          // console.log(ret);
          data = JSON.parse(ret);
          console.log(data)
          $.each(data, function (key, item) {
              $('#district').append($('<option>', { 
                  value: item.dis_id,
                  text : item.dis_name 
              }));
          });
          }
        })
      });

    $('#district').on('change', function(){
    let district_id = $('#district').val()
    $.ajax({
      url : "{{url('/getsubdistrict')}}",
      type : 'post',
      headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
      },
      data : {'id': district_id},
      success: function(ret) { 
          data = JSON.parse(ret);
          console.log(data)
          $.each(data, function (key, item) {
              $('#subdistrict').append($('<option>', { 
                  value: item.subdis_id,
                  text : item.subdis_name 
              }));
          });
          }
        })
      });



</script>
@endsection