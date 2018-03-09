@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if ($photos)
        <form class="form-inline" action="/delete/media" method="post">

            {{csrf_field()}}
            {{method_field('delete')}}

            <div class="form-group">
                <select name="checkBoxArray" id="">
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn-primary">
            </div>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
                <th>Id</th>
                <th>Name</th>
                <th>Created date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($photos as $photo)
            <tr>
                <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
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


        </form>
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#options').click(function(){

                if(this.checked){
                    $('.checkboxes').each(function(){
                        this.checked = true;
                    })
                } else {
                    $('.checkboxes').each(function(){
                        this.checked = false;
                    })
                }

            });
        });
    </script>
@stop