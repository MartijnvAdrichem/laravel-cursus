@extends('layouts.admin')


@section('content')

    <h1>Edit Post</h1>
    <div class="col-sm-4">

        <img src="{{$post->photo ? $post->photo->path : '/images/placeholder.jpg'}}" alt ="" class="img-responsive img-rounded">
    </div>
    <div class="col-sm-8">
        {!! Form::model($post, ['action' => ['AdminPostsController@update', $post->id], 'method' => 'PATCH', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', array(''=>'Choose category') + $categories ,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null,['class'=>'form-control', 'rows'=>3]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update post', ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>


        {!! Form::close() !!}

        {!! Form::open(['action' => ['AdminPostsController@update', $post->id], 'method' => 'DELETE']) !!}

        <div class="form-group">
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>

        {!! Form::close() !!}

    </div>
    @include('includes.form-error')

@stop