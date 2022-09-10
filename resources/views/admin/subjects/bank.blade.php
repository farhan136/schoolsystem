@extends('layouts.app')

@section('title', 'Question Bank')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Question Bank</h1>
          </div>
          
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        @foreach($subject as $rowsubject)
        <section class="col-4">
            <div class="card">
            <div class="card-header border-transparent modal-lg">
              <h3 class="card-title">{{$rowsubject->name}}</h3><br>
            </div>
              <div class="card-body p-0">
                <button class="btn btn-xs btn-success card-modal button-view" data-id="{{$rowsubject->id}}">View</button>
                <button class="btn btn-xs btn-primary card-modal button-create" data-toggle="modal" data-target="#modal-info" data-id="{{$rowsubject->id}}">Create</button>
                <br>
                <img src="{{asset('/picture/general/background.jpg')}}" style="width: 100%; height: 200px;">
              </div>
            </div>    
        </section>
        @endforeach
        
      </div>
    </div>

    <div class="modal fade" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content bg-default">
          <div class="modal-header">
          <h4 class="modal-title">Create Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
            <form id="quickform" method="post">
                @csrf
                <div class="card-body question-card">
                  <div class="question_number">
                    <div class="form-group">
                      <label>Level</label>
                      <input type="number" min="1" max="10" name="level" class="form-control input-question" placeholder="Choose the level of question" autocomplete="off" required>
                      <label>Pertanyaan</label>
                      <input type="text" name="question" class="form-control input-question" placeholder="Fill this field" autocomplete="off" required> 
                      <label>Jawaban</label>
                      <div class="answer_number">
                        <div class="row mb-2">
                          <div class="col-2">
                            <input type="text" class="form-control radio-answer" name="istrue[]" readonly value="">
                          </div>
                          <div class="col-10">
                            <input type="text" name="answer[]" class="form-control input-answer" placeholder="Fill this field" autocomplete="off" required>    
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-2">
                            <input type="text" class="form-control radio-answer" name="istrue[]" readonly value="">
                          </div>
                          <div class="col-10">
                            <input type="text" name="answer[]" class="form-control input-answer" placeholder="Fill this field" autocomplete="off" required>    
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-2">
                            <input type="text" class="form-control radio-answer" name="istrue[]" readonly value="">
                          </div>
                          <div class="col-10">
                            <input type="text" name="answer[]" class="form-control input-answer" placeholder="Fill this field" autocomplete="off" required>    
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-2">
                            <input type="text" class="form-control radio-answer" name="istrue[]" readonly value="">
                          </div>
                          <div class="col-10">
                            <input type="text" name="answer[]" class="form-control input-answer" placeholder="Fill this field" autocomplete="off" required>    
                          </div>
                        </div>
                        
                      </div>
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
@endsection

@section('additionalscript')
<script>

  $('#modal-info').on('hidden.bs.modal', function(){
    $('.radio-answer').css('background-color', '#E9ECEF')
    $('.radio-answer').val('')
    $('.input-answer').val('')
    $('.input-question').val('')
  })

  $('.answer_number .radio-answer').on('click', function(){
    $('.radio-answer').css('background-color', '#E9ECEF')
    $('.radio-answer').val('')
    $(this).css('background-color', '#28A745')
    $(this).val('true')
  });

  $('.button-create').on('click', function(){
    let id = $(this).attr('data-id');
    let url = "{{url('/subject/storebank')}}"+"/"+id
    $('#quickform').attr('action', url)
  })

  $('.button-view').on('click', function(){
    let id = $(this).attr('data-id');
    window.open(
        "{{url('/subject/viewbank')}}"+"/"+id, 
        '_blank', 
        'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });
</script>
@endsection