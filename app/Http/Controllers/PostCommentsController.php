<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller{


    public function index() {

        $comments = Comment::all();

        return view('admin.comments.index', compact('comments'));
    }

    public function create() {
    }

    public function store(Request $request) {


        $user = Auth::user();

        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->path,
            'body' => $request->body,
        ];

        Comment::create($data);

        $request->session()->flash("message", 'Your message has been submitted and is waiting moderation');

        return redirect()->back();
    }

    public function show($id) {
        $comments = Comment::where('post_id', $id)->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

        Comment::findOrFail($id)->update($request->all());
        return redirect()->back();
    }


    public function destroy($id) {

        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }

}
