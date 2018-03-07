@extends('layouts.blog-post')


@section('content')


    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <img class="img-responsive" src="{{$post->photo ? $post->photo->path : '/images/placeholder.jpg'}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>
    <hr>

    @if (Session::has('message'))
        {{session('message')}}
    @endif
    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if (Auth::check())
    <div class="well">
        <h4>Leave a Comment:</h4>
        {!! Form::open(['action' => 'PostCommentsController@store', 'method' => 'post']) !!}

        <input type="hidden" name="post_id" value="{{$post->id}}">
        	<div class="form-group">
        	    {!! Form::label('body', 'Body:') !!}
        	    {!! Form::textarea('body', null,['class'=>'form-control', 'rows'=>3]) !!}
        	</div>
            <div class="form-group">
                {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    @endif

    <hr>

    <!-- Posted Comments -->
@if (count($comments) > 0)
    <!-- Comment -->
    @foreach ($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" width="64" class="media-object" src="{{$comment->photo ? $comment->photo : '/images/placeholder.jpg'}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}



        @foreach ($comment->replies as $reply)
                @if ($reply->is_active)
            <div id="nested-comment" class="media">
                <a class="pull-left" href="#">
                    <img  height="64" width="64" class="media-object" src="{{$reply->photo ? $reply->photo : '/images/placeholder.jpg'}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$reply->author}}
                        <small>{{$reply->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$reply->body}}
                </div>
            </div>
                @endif
                @endforeach

            <div class="comment-reply-container">

                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                <div class="comment-reply">
                    {!! Form::open(['action' => 'CommentRepliesController@createReply', 'method' => 'post']) !!}

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <div class="form-group">
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null,['class'=>'form-control', 'rows'=>3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Submit reply', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
            <!-- End Nested Comment -->
    </div>
    @endforeach
@endif



@stop

@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function () {

            $(this).next().slideToggle("fast");
        });
    </script>

@stop