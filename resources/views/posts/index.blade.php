@extends('layouts.app')

@section('content')
<h1>posts</h1>


<div class="row box">
 <div class="col-lg-9 col-md-6 col-sm-3">

  @if (count($posts) > 0)
   @foreach ($posts as $post)
<div class='post-box'>
       <div class="row">
              <div class="col-lg-8  col-md-6 col-sm-4">
                 <img style="width: 750;height: 300;margin-bottom: 25px;"src="/storage/cover_images/{{$post->cover_image}}">
              </div>

              </div>
               <div class="row">
              <div class="col-lg-8 col-md-6 col-sm-4 ">
                   <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                   {!!$post->body!!}
              </div>
              </div>
              <div class="row">
                
                </div>
               
               <div class="row comment">
              
               
                <div class="col-lg-8 col-md-6 col-sm-4">
                 @if (count($comments) > 0)
                     @foreach ($comments as $comment)
                         @if($comment->p_id==$post->id)
                         <div>
                           
           
                          
                  <div class="tools">
                          <span >{{$comment->user->name}}:</span>
                          <span style="margin-left:10px;margin-right:15px;">{{$comment->body}}</span>
                        <!-- Button trigger modal -->
                       <a href="/comments/{{$comment->id}}"><li class="fa fa-edit fa-2x" style="    margin-right: 5px;"></li></a>
                        {!!Form::open(['action'=>['CommentController@destroy',$comment->id],'method'=>'POST'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::button('<i class="fa fa-trash"></i>',['type' => 'submit','class' => 'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                  </div>             

            </div>
                     
                        
                         @endif
                     @endforeach
                    @endif


                  {!! Form::open(['action'=>'CommentController@store','class'=>'form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
               <div class="form-group">
                  {{Form::text('body','',['class'=>'form-control','style'=>'margin-top: 40px;','placeholder'=>'Comment','rows'=>'1'])}}
               </div>
               <div class="form-group" style="display:none;">
                  {{Form::text('p_id',$post->id,['class'=>'form-control','placeholder'=>'comment','value'=>$post->id])}}
                  {{Form::submit('submit',['class'=>'btn btn-primary '])}}
                  {!! Form::close() !!}
               </div> 
                <div class="space">
                </div>
        </div>
         <div class="col-lg-12  col-md-6 col-sm-4 info">
                    <span class='post-date'>Posted on {{$post->created_at}} by <a href="#">{{$post->user->name}}</a></span>
          </div>
        </div>
      </div>
                  @endforeach
                @else
                <p>no posts found</p>
              @endif

            </div>
        


 <div class="col-lg-3 col-sm-2 search-box">
                  <div class="card" style=" width: 19rem;">
                   <div class="card-header">
                     <strong>Search</strong>
                  </div>
                     <div class="card-body">
                     
                    <form action="/search" method="get">

              <div class="input-group">
                  <input type="search" class="form-control"placeholder="Search users" name="search"> 
                  <span class="input-group-btn">
                      <span class="input-group-prepend">
                      <button type="submit" class="btn btn-primary">
                         Go
                      </button>
                      </span>
        </span>
    </div>
</form>   
               </div>  
               </div>


                  <div class="card" style=" width: 19rem; margin-top: 20px;">
                   <div class="card-header">
                      <strong>Categories</strong>
                  </div>
                     <div class="card-body">
                   <div class="cat">   
                @foreach($posts as $post)
                   <a href="{{ route('cats.searchcat', [$post->tags]) }}" id="cats">{{$post->tags}}</a>
                @endforeach
                </div> 
               </div>
               </div>
               @if(Auth::user()->auth=='admin' || Auth::user()->auth=='author')
                   <a href="/posts/create" style="margin-top: 20px;
                   width: 308px;
                   font-weight: bold;
                   font-size: larger;"class="btn btn-primary">create post</a>
               @endif
              </div>
            
              @endsection

<style>
.space
{
       height: 20px;
    width: 2000;
    /* margin-right: 42px; */
    margin-left: -17px;
    background-color: #fff;
}
.cat a{
 padding: 36px;
     text-decoration: none;
}
.box{
   display: flex;
    flex-wrap: wrap;
    margin-right: 63px;
    margin-left: -15px;
}
.tools{

  display: -webkit-inline-box;
    margin-top: 10px;
    /* float: right; */
    /* margin-left: 12px; */
    margin-bottom: 5px;
}
 .comment-delete {
  
  
    
}
 .comment-edit{
   margin-right:5px;
      
 }
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
  
}
.comment
{
   margin-top;10px;
   background-color:#ddd;
}
.info{
  background-color:#ddd;
  padding: 15px;
 
}
.form-group {
     margin-top:15px;
    margin-left: 34px;
    width: 95%;
    display:inline-block;
    margin-bottom;0;

}
.mod
{
        margin-top: 2px;
    margin-left: 10px;
    width: 98%;
    display:inline-block;
    margin-bottom;0;
}
.form {
      display:inline-block;
          margin-bottom: 0;
}


  /* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
 div.form-group {
     width: 170%;
    }

}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
   
    div.form-group {
     width: 300%;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
   
    div.form-group {
     width: 100%;
    }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
   
    div.form-group {
     width: 250%;
    }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
   
    div.form-group {
     width: 300%;
    }
}





  /* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
 div.comment {
     width: 100%;
    }

}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
   
    div.comment{
     width: 50%;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
   
    div.comment {
     width:103%;
    }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
   
    div.comment {
     width: 105%;
    }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
   
    div.comment {
     width: 104%;
    }
}
</style>

