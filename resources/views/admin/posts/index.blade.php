@extends('layouts.admin')


@section('content')

    <h1>Posts</h1>

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Post id</th>
                <th>Made by</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>

            </tr>
        </thead>
        <tbody>
        @if ($posts)
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                <td>{{$post->category->name}}</td>
                <td><img height="50" src="{{$post->photo ? $post->photo->path : '/images/placeholder.jpg'}}" alt=""></td>
                <td>{{$post->title}}</td>
                <td>{{str_limit($post->body, 50)}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
                <td><a href="{{route('home.post', $post->slug)}}" >View post</a></td>
                <td><a href="{{route('admin.comments.show', $post->id)}}" >View comments</a></td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop