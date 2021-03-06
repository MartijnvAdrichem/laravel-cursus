<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller {

    public function index() {

        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }


    public function create() {

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }


    public function store(UserRequest $request) {

        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request['password']);
        User::create($input);
        Session::flash('message', 'The user has been created');
        return redirect('/admin/users');
    }


    public function show($id) {
    }

    public function edit($id) {

        $roles = Role::pluck('name', 'id')->all();
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(EditUserRequest $request, $id) {

        $user = User::findOrFail($id);

        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request['password']);
        }

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        Session::flash('message', 'User '. $user->name. ' has been updated');

        return redirect('/admin/users');
    }


    public function destroy($id) {

        $user = User::findOrFail($id);

        if($user->photo) {
            unlink(public_path() . $user->photo->path);
        }

        $user->delete();

        Session::flash('message', 'The user has been deleted');


        return redirect('admin/users');
    }
}
