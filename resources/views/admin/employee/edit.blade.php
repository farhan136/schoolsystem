@extends('layouts.form')

@section('title', 'Create Class')

@section('additionalstyle')
<style>
    .content-wrapper {background-color:#ffbc65 !important;}
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
              <h3 class="card-title">{{$state}} {{$employee->name}}</h3>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/employee/update/'.$employee->id. '/1')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Registration Number</label>
                    <input type="text" class="form-control"  autocomplete="off" value="{{$employee->registration_number}}" required disabled>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" id="inputname" placeholder="Enter name" autocomplete="off" value="{{$employee->name}}" required {{ $disabled }}>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="inputemail" placeholder="Enter email" autocomplete="off" required {{ $disabled }} value="{{$employee->email}}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="number" class="form-control" id="inputnumber" placeholder="Enter number" autocomplete="off" value="{{$employee->phone_number}}" required {{ $disabled }}>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control" id="inputreligion" placeholder="Enter religion" autocomplete="off" value="{{$employee->religion}}" required {{ $disabled }}>
                  </div>
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select class="form-control select2" style="width: 100%;" name="marital" autocomplete="off" required {{ $disabled }}>
                      <option value="Single" <?php if ($employee->marital_status == 'Single') echo 'selected'?>>Single</option>
                      <option value="Married" <?php if ($employee->marital_status == 'Married') echo 'selected'?>>Married</option>
                      <option value="Widow" <?php if ($employee->marital_status == 'Widow') echo 'selected'?>>Widow</option>
                    </select>
                    @error('marital')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" style="width: 100%;" name="gender" autocomplete="off" required {{ $disabled }}>
                      <option value="Male" <?php if ($employee->gender == 'Male') echo 'selected'?>>Male</option>
                      <option value="Female" <?php if ($employee->gender == 'Female') echo 'selected'?>>Female</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" placeholder="Enter date" autocomplete="off" value="{{$employee->date_of_birth}}" required {{ $disabled }}>
                    @error('dateofbirth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Province</label>
                    <select class="form-control select2" style="width: 100%;" name="province" id="province" autocomplete="off" required {{ $disabled }}>
                      <option value="" selected></option>
                      @foreach($provinces as $province)
                        @if($employee->province == $province->prov_id)
                          <option value="{{ $province->prov_id }}" selected>{{ $province->prov_name }}</option>
                        @else
                          <option value="{{ $province->prov_id }}">{{ $province->prov_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control select2" style="width: 100%;" name="city" id="city" autocomplete="off" required {{ $disabled }}>
                      <option value="" selected></option>
                      @foreach($cities2 as $city)
                        @if($employee->city == $city->city_id)
                          <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
                        @else
                          <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>District</label>
                    <select class="form-control select2" style="width: 100%;" name="district" id="district" autocomplete="off" required {{ $disabled }}>
                      <option value="" selected></option>
                      @foreach($districts as $district)
                        @if($employee->district == $district->dis_id)
                          <option value="{{ $district->dis_id }}" selected>{{ $district->dis_name }}</option>
                        @else
                          <option value="{{ $district->dis_id }}">{{ $district->dis_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subdistrict</label>
                    <select class="form-control select2" style="width: 100%;" name="subdistrict" id="subdistrict" autocomplete="off" required {{ $disabled }}>
                      <option value="" selected></option>
                      @foreach($subdistricts as $subdistrict)
                        @if($employee->subdistrict == $subdistrict->subdis_id)
                          <option value="{{ $subdistrict->subdis_id }}" selected>{{ $subdistrict->subdis_name }}</option>
                        @else
                          <option value="{{ $subdistrict->subdis_id }}">{{ $subdistrict->subdis_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control select2" style="width: 100%;" name="role" id="role" autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($role as $rowrole)
                        <?php if($employee->role == $rowrole->code){
                          $selected = 'selected';
                        }else{
                          $selected = '';
                        }?>
                        @if($rowrole->code == 99)
                          <option value="{{ $rowrole->code }}" <?= $selected; ?>>{{ $rowrole->name }}</option>
                        @else
                          <option value="{{ $rowrole->code }}" <?= $selected; ?>>Guru {{ $rowrole->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Enter address" autocomplete="off" required {{ $disabled }} rows="5">{{$employee->address}}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Place Of Birth</label>
                    <select class="form-control select2" style="width: 100%;" name="placeofbirth" autocomplete="off" required {{ $disabled }}>
                      <option value="" selected></option>
                      @foreach($cities as $city)
                        @if($employee->place_of_birth == $city->city_id)
                          <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
                        @else
                          <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('placeofbirth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                   <div class="form-group">
                    <label>Photo</label>
                    <div class="col-md-6"><img src="{{asset('/')}}picture/employee/{{$employee->photo}}" style='max-width:90px;'></div>
                    <br>
                    <div class="col-md-6">
                      <input type="file" name="photo" class="form-control" placeholder="Enter date" autocomplete="off" {{ $disabled }}>
                      @error('photo')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror  
                    </div>
                    
                  </div>
                </div>
                @if($disabled == '')
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                @endif
                
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

  });


    $('#province').on('change', function(){
    let province_id = $('#province').val()
    $('#city > option').remove();
    $('#district > option').remove();
    $('#subdistrict > option').remove();
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
                  text : item.city_name,
                  selected : 'selected' 
              }));
          });
          }
        })
      });

    $('#city').on('change', function(){
    let city_id = $('#city').val()
    $('#district > option').remove();
    $('#subdistrict > option').remove();
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
    $('#subdistrict > option').remove();
    $.ajax({
      url : "{{url('/getsubdistrict')}}",
      type : 'post',
      headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
      },
      data : {'id': district_id},
      success: function(ret) { 
          // console.log(ret);
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