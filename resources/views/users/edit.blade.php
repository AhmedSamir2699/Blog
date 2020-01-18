@extends('layouts.app')

@section('content')
<div class="modal-content">
    <div class="modal-header">
      Edit Comment
    </div>
<div class="modal-body">
    {!! Form::open(['action'=>['HomeController@update',$user->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}

      <div class="mod">
          {{Form::label('name','Name')}}
          {{Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Name'])}}
      </div>

      <div class="mod">
            {{Form::label('email','Email')}}
            {{Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Email'])}}
      </div>
      <div class="mod">
            {{Form::label('password','Password')}}
            {{Form::text('password','',['class'=>'form-control','placeholder'=>'Password'])}}
      </div>
      <div class="mod" style="margin-bottom: 15px;">
            {{Form::label('Authroization','Authroization')}}
            {!! Form::select('auth', array('admin' => 'Admin', 'author' => 'author','user'=>'User'), $user->auth,['class'=>'form-control']); !!}
      </div>
      <div class="mod">
              {{Form::label('Profile Image','Profile Image')}}
              {{Form::file('cover_image')}}
      </div>
              {{Form::hidden('_method','PUT')}}
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {{Form::submit('submit',['class'=>'btn btn-primary'])}}
              {!! Form::close() !!}
        </div>
      </div>
    </div>
  

@endsection