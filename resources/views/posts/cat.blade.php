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
               <div class="col-lg-12  col-md-6 col-sm-4 info">
                    <span class='post-date'>Posted on {{$post->created_at}} by <a href="#">{{$post->user->name}}</a></span>

                </div>
                <div class="col-lg-8 col-md-6 col-sm-4">
                 @if (count($comments) > 0)
                     @foreach ($comments as $comment)
                         @if($comment->p_id==$post->id)
                         <div>
                            <span style="margin-left:37px;font-weight: bold;margin-top:5px">{{$comment->user->name}}:</span>
                           <span style="margin-left:10px">{{$comment->body}}</span>
                         @if (!Auth::guest())
                     @if(Auth::user()->id == $post->user_id || Auth::user()->auth=='admin')
                     <div class="tools">
                    
                     <!-- Button trigger modal -->
<button type="button" class="btn btn-secondary comment-edit" data-toggle="modal" data-target="#exampleModal">
  Edit
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
  </div>
</div>



                     {!!Form::open(['action'=>['CommentController@destroy',$comment->id],'method'=>'POST'])!!}
                     {{Form::hidden('_method','DELETE')}}
                     {{Form::submit('Delete',['class'=>'btn btn-danger comment-delete'])}}
                     {!!Form::close()!!}
                     </div>
                     @endif
                     @endif
                         </div>
                      
                         @endif
                     @endforeach
                    @endif
            {!! Form::open(['action'=>'CommentController@store','class'=>'form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

               <div class="form-group">
                  {{Form::text('body','',['class'=>'form-control','placeholder'=>'Comment','rows'=>'1'])}}
                  
               </div>

               <div class="form-group" style="display:none;">
                  {{Form::text('p_id',$post->id,['class'=>'form-control','placeholder'=>'comment','value'=>$post->id])}}
                  {{Form::submit('submit',['class'=>'btn btn-primary '])}}
               </div>

                  
               {!! Form::close() !!}
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
                 @foreach($allpost as $post)
                   <a href="{{ route('cats.searchcat', [$post->tags]) }}" id="cats">{{$post->tags}}</a>
                @endforeach
                 </div>
                 
               </div>
               </div>
              </div>

              </div>
            
              @endsection
<script>

</script>
<style>
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
    margin-top: -9px;
    float: right;
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
  margin-bottom:10px;
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

