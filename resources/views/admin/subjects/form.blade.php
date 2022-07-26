@extends('layouts.form')

@section('title', 'Create Subject')

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
              <h3 class="card-title">Form Subject</h3>
            </div>
            <?php if ($state == 'Add') {
              $url = '/subject/store';
            }else{
              $url = '/subject/store/'.$subject->id. '/1';
            } ?>
            <div class="card-body p-0">
              <form action="{{url($url)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" autocomplete="off" required value="{{ !empty($subject)? $subject->name : '' }}">
                  </div>
                  <div class="form-group">
                    <label>Kode</label>
                    <input type="number" name="code" class="form-control" min="1" placeholder="Enter Code" autocomplete="off" required value="{{ !empty($subject)? $subject->code : '' }}">
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

</script>
@endsection