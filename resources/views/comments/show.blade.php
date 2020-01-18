@extends('layouts.app')

@section('content')
<h1></h1>
<!-- Modal -->

    <div class="modal-content">
      <div class="modal-header">
        Edit Comment
      </div>
      <div class="modal-body">
                   {!! Form::open(['action'=>['CommentController@update',$comment->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}

                    <div class="mod">
                        {{Form::text('body',$comment->body,['class'=>'form-control','placeholder'=>'Body'])}}
                    </div>

                        {{Form::hidden('_method','PUT')}}
   
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('submit',['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </div>
                  </div>
               
              @endsection