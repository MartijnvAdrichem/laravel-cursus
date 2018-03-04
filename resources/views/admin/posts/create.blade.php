@extends('layouts.admin')


@section('content')

    <h1>Create Post</h1>

    {!! Form::open(['action' => 'AdminPostsController@store', 'method' => 'post', 'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', array('1'=>'PHP','2'=>'Javascript'),null,['class'=>'form-control']) !!}
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
        {!! Form::submit('Create post', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('includes.form-error')

@stop