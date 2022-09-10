@extends('layouts.form')

@section('title', 'View Bank Question')

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
              <h3 class="card-title">Question Bank {{$subjects->name}}</h3>
            </div>
            <div class="card-body p-0">
              <form action="#" method="post">
                @csrf
                <div class="card-body">
                  @foreach($questions as $question)
                  <div class="form-group">
                    <div class="row mb-2">
                      <div class="col-1">
                          <input type="text" class="form-control radio-answer" readonly value="{{$loop->iteration}}">
                      </div>
                      <div class="col-10">
                        <input type="text" class="form-control input-answer" readonly value="{{$question->question}}">    
                      </div>
                      <div class="col-1">
                          <input type="text" class="form-control radio-answer" readonly value="{{$question->level}}">
                      </div>
                    </div>
                    <?php $falseanswer = explode(';', $question->false_answer); ?>
                    @foreach($falseanswer as $false)
                    @if($false != '')
                    <div class="row mb-2">
                      <input type="text" class="form-control input-answer" readonly value="{{$false}}">    
                    </div>
                    @endif
                    @endforeach
                    <div class="row mb-2">
                      <input type="text" class="form-control input-answer" style="background-color: #28A745" readonly value="{{$question->true_answer}}">
                    </div>
                  </div>

                @endforeach
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