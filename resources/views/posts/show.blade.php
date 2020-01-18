@extends('layouts.app')

@section('content')


<div class='post-box'>
       <div class="row">
              <div class="col-md-8 col-sm-4">
                 <img style="width: 750;height: 300;margin-bottom: 25px;"src="/storage/cover_images/{{$post->cover_image}}">
              </div>
              </div>
               <div class="row">
              <div class="col-md-8 col-sm-8 ">
                   <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                   {!!$post->body!!}
              </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-sm-8 info">
                    <span class='post-date'>Posted on {{$post->created_at}} by {{$post->user->name}}</span>

                </div>

                <div class="col-md-4 col-sm-4 tools">
                    @if (!Auth::guest())
                    
                     <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary post-viwes2">Edit</a>
                     {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                     {{Form::hidden('_method','DELETE')}}
                     {{Form::submit('Delete',['class'=>'btn btn-danger post-viwes'])}}
                     {!!Form::close()!!}
                   
                     @endif
                         <a href="/posts" class="btn btn-primary" >Go Back </a>
                </div>
                </div>
          </div>
</div>

@endsection
<style>
.info{
  background-color:#ddd;
  padding: 15px;
}
.tools{
  background-color:#ddd;
  padding: 15px; 
}
.post-box .post-viwes
    {
      
      text-align: center;
    font-weight: bold;
    margin-right: 346px;
    margin-top: -37px;
    }
.post-box .post-viwes2
    {
       
    
        font-weight: bold;
    }
</style>