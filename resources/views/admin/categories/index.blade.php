@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="col-sm-6">
        {!! Form::open(['action' => 'AdminCategoriesController@store', 'method' => 'post']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>


    <div class="col-sm-6">

        @if ($categories)
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>

@stop