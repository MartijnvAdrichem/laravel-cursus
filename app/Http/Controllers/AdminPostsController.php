<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller {

    public function index() {


        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create() {

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostsCreateRequest $request) {

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user = Auth::user();
        $user->posts()->create($input);

        return redirect('/admin/posts');


    }

    public function show($id) {

    }

    public function edit($id) {

        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostsCreateRequest $request, $id) {

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user = Auth::user();
        $user->posts()->whereId($id)->first()->update($input);

        return redirect('admin/posts');

    }

    public function destroy($id) {

        $post = Post::findOrFail($id);

        if($post->photo) {
            unlink(public_path() . $post->photo->path);
        }

        $post->delete();

        Session::flash('message', 'The post has been deleted');

        return redirect('admin/posts');
    }

    public function post($id){

        $post = Post::findOrFail($id);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post', compact('post', 'comments'));

    }
}


/*
    public function index() {
    }

    public function create() {
    }

    public function store(Request $request) {

    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
 */