<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller {

    public function index() {

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    public function create() {

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }


    public function store(UserRequest $request) {

        User::create($request->all());

        return redirect('/admin/users');
    }


    public function show($id) {
    }

    public function edit($id) {

        return view('admin.users.edit');
    }


    public function update(Request $request, $id) {
    }


    public function destroy($id) {
    }
}
