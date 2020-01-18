@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  
                     <!-- Button trigger modal -->
<button type="button" class="btn btn-success"  style="float:right;margin-bottom: 12px;" data-toggle="modal" data-target="#adduser">
  Add User
</button>

<!-- Modal -->
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduserLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                 {!! Form::open(['action'=>'HomeController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}

                      <div class="mod">
                          {{Form::label('name','Name')}}
                          {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
                      </div>
                      <div class="mod">
                          {{Form::label('email','Email')}}
                          {{Form::text('email','',['class'=>'form-control','placeholder'=>'Email'])}}
                      </div>
                      <div class="mod">
                          {{Form::label('password','Password')}}
                          {{Form::text('password','',['class'=>'form-control','placeholder'=>'Password'])}}
                      </div>
                      <div class="mod" style="margin-bottom: 15px;">
                             {{Form::label('Authroization','Authroization')}}
                             {!! Form::select('auth', array('admin' => 'Admin', 'author' => 'author','user'=>'User'), 'user',['class'=>'form-control']); !!}
                      </div>
                      <div class="mod">
                        {{Form::label('Profile Image','Profile Image')}}
                        {{Form::file('cover_image')}}
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{Form::submit('Add',['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                     </div>
                </div>
              </div>
            </div>


                   <h3>Users</h3>
                    <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user )
                        <tr>
                            <td>{{$user->name}}</td>
                            
                  <td> <a href="/users/{{$user->id}}"><li class="fa fa-edit fa-2x" style="    margin-right: 5px;"></li></a></td>
                            <td>
                                {!!Form::open(['action'=>['DashbordController@destroy',$user->id],'method'=>'POST','class'=>'pull-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::button('<i class="fa fa-trash"></i>',['type' => 'submit','class' => 'btn btn-danger btn-sm'])}}
                                {!!Form::close()!!}
                            </td>
                            <td> {{$user->auth}}</td>
                       </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.mod
{
        margin-top: 2px;
    margin-left: 10px;
    width: 98%;
    display:inline-block;
    margin-bottom;0;
}
</style>