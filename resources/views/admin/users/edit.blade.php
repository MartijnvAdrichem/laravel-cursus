@extends('layouts.admin')

@section('content')

    <h1>Edit Users</h1>


    <div class="row">

    <div class="col-sm-3">

        <img src="{{$user->photo ? $user->photo->path : '/images/placeholder.jpg'}}" alt ="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', $roles,  null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', 'Role:') !!}
            {!! Form::select('is_active', array(true=>'Active', false=>'Not Active') ,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Select a photo:') !!}
            {!! Form::file('photo_id', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update user', ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

        <div class=" form-group">
            {!! Form::submit('Delete user', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>

        {!! Form::close() !!}

    </div>
    </div>
    <div class="row">
        @include('includes.form-error')
    </div>
@endsection()