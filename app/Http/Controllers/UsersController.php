<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', ['users'=>$users]);
    }

    public function edit(User $user){
        return view('users.editUser')->with
        (['user'=>$user]);
    }

    public function update(Request $request, User $user){
        $user->update($request->all());
        return redirect('/users');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect('/users');
    }

}
