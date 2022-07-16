@extends('layouts.form')

@section('title', 'Create Student')

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
              <h3 class="card-title">Form Student</h3>
            </div>
            <?php if ($state == 'Add') {
              $url = '/student/store';
            }else{
              $url = '/student/store/'.$student->id. '/1';
            } ?>
            <div class="card-body p-0">
              <form id="quickform" action="{{url($url)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" id="inputname" placeholder="Enter name" autocomplete="off" required value="{{ !empty($student)? $student->name : '' }}" {{ $disabled }}>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" id="inputemail" placeholder="Enter email" autocomplete="off" required value="{{ !empty($student)? $student->email : '' }}" {{ $disabled }}>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="number" class="form-control" id="inputnumber" placeholder="Enter number" autocomplete="off" required value="{{ !empty($student)? $student->phone_number : '' }}" {{ $disabled }}>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control select2" style="width: 100%;" name="gender" autocomplete="off" required {{ $disabled }}>
                      <option value="Male" {{ !empty($student) && $student->gender == 'Male'? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ !empty($student) && $student->gender == 'Female'? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Date Of Birth</label>
                    <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" value="{{ !empty($student)? $student->date_of_birth : '' }}" placeholder="Enter date" autocomplete="off" required {{ $disabled }}>
                    @error('dateofbirth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Place Of Birth</label>
                    <select class="form-control select2" style="width: 100%;" name="placeofbirth" {{ $disabled }} autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($cities as $city)
                        @if(!empty($student) && $student->city == $city->city_id)
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
                    <label>Class</label>
                    <select class="form-control select2" style="width: 100%;" name="class" id="class" {{ $disabled }} autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($classes as $class)
                        @if(!empty($student) && $student->class_id == $class->id)
                          <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                        @else
                          <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Province</label>
                    <select class="form-control select2" style="width: 100%;" name="province" id="province" {{ $disabled }} autocomplete="off" required>
                      <option value="" selected></option>
                      @foreach($provinces as $province)
                        @if(!empty($student) && $student->province == $province->prov_id)
                          <option value="{{ $province->prov_id }}" selected>{{ $province->prov_name }}</option>
                        @else
                          <option value="{{ $province->prov_id }}">{{ $province->prov_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control select2" style="width: 100%;" name="city" id="city" autocomplete="off" {{ $disabled }} required>
                      <option value="" selected></option>
                      @if(!empty($student))
                        @foreach($cities2 as $city)
                          @if($student->city == $city->city_id)
                            <option value="{{ $city->city_id }}" selected>{{ $city->city_name }}</option>
                          @else
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>District</label>
                    <select class="form-control select2" style="width: 100%;" name="district" id="district" autocomplete="off" {{ $disabled }} required>
                      <option value="" selected></option>
                      @if(!empty($student))
                        @foreach($districts as $district)
                          @if($student->district == $district->dis_id)
                            <option value="{{ $district->dis_id }}" selected>{{ $district->dis_name }}</option>
                          @else
                            <option value="{{ $district->dis_id }}">{{ $district->dis_name }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subdistrict</label>
                    <select class="form-control select2" style="width: 100%;" {{ $disabled }} name="subdistrict" id="subdistrict" autocomplete="off" required>
                      <option value="" selected></option>
                      @if(!empty($student))
                        @foreach($subdistricts as $subdistrict)
                          @if($student->subdistrict == $subdistrict->subdis_id)
                            <option value="{{ $subdistrict->subdis_id }}" selected>{{ $subdistrict->subdis_name }}</option>
                          @else
                            <option value="{{ $subdistrict->subdis_id }}">{{ $subdistrict->subdis_name }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Enter address" autocomplete="off" {{ $disabled }} required rows="5">{{ !empty($student)? $student->address : '' }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Photo</label>
                  @if(!empty($student))
                    <div class="col-md-6"><img src="{{asset('/')}}picture/{{$student->photo == 'default.jpg'? 'employee': 'student'}}/{{$student->photo}}" style='max-width:90px;'></div>
                    <br>
                    <div class="col-md-6">
                      <input type="file" name="photo" class="form-control" placeholder="Enter date" autocomplete="off" {{ $disabled }}>  
                    </div>
                  @else
                    <div class="col-md-6">
                      <input type="file" name="photo" class="form-control" placeholder="Enter date" required autocomplete="off" {{ $disabled }}>
                    </div>
                  @endif
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
  // $(function () {
  //   $( "#dateofbirth" ).datepicker();    
  // });

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
          $('#city').append($('<option>', { 
                  value: '',
                  text : '' 
              }));
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
          $('#district').append($('<option>', { 
                  value: '',
                  text : '' 
              }));
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
          $('#subdistrict').append($('<option>', { 
                  value: '',
                  text : '' 
              }));
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