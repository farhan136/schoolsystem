@extends('layouts.form')

@section('title', 'Detail Class')

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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Kehadiran Kelas</h3>
              
            </div>
            <div class="card-body p-0" style="height: 500px;">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Nilai Kelas</h3>
              
            </div>
            <div class="card-body p-0" style="height: 500px;">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Nilai Mata Pelajaran</h3>
              
            </div>
            <div class="card-body p-0" style="height: 500px;">
              
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

</script>
@endsection