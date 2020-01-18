@extends('layouts.app')

@section('content')
<div class="container">

	
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                @foreach ($users as $user)
                 @if (Auth()->user()->id==$user->id)
                 <div class="row">
                    <div class="col-lg-4  col-md-4 col-sm-2">
                      <img style="width: 200px;height: 200px;"src="/storage//profile_image/{{$user->profile_image}}">
                    </div>
               <div class="col-lg-8  col-md-6 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">My Information</div>
                        <div class="panel-body">
                          <ul class="list-unstyled">
                            <li>
                              <i class="fa fa-unlock-alt fa-fw"></i>
                              <span>Login Name</span> : {{$user->name}}
                            </li>
                            <li>
                              <i class="fa fa-envelope-o fa-fw"></i>
                              <span>Email</span> : {{$user->email}}
                            </li>
                            <li>
                              <i class="fa fa-calendar fa-fw"></i>
                              <span>Registered Date</span> : {{$user->created_at}}
                            </li>
                            <li>
                              <i class="fa fa-tags fa-fw"></i>
                              <span>Fav Category</span> 
                            </li>
                          </ul>
				
                                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary comment-edit" data-toggle="modal" data-target="#exampleModal">
                          Edit Information
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
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
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      {{Form::submit('submit',['class'=>'btn btn-primary'])}}
                                      {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif   
                @endforeach
                   
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->auth=='admin')
                   <a href="/posts/create" style="float: right;margin-top: 20px;"class="btn btn-primary">create post</a>
                   <br>
                   <h3>your Blog posts</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post )
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                          </tr>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
