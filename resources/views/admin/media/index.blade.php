@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if ($photos)
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td><img height="50" src="{{$photo->path}}" alt=""></td>
                <td>{{$photo->created_at->diffForHumans()}}</td>
                <td>{!! Form::open(['action' => ['AdminMediasController@destroy', $photo->id], 'method' => 'DELETE']) !!}
                     <div class="form-group">
                    {!! Form::submit('Delete post', ['class'=>'btn btn-danger']) !!}
                    </div>
                {!! Form::close() !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

@stop