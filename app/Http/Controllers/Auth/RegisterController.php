<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index() {
        $users = User::all();
        return view('list', compact('users'));
    }

    public function register() {
        return view('user');
    }

    public function show($id) {
        $users = User::find($id);
        return view('administrator', compact('users'));
    }

    public function store(Request $request) {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/administrator/list');
    }

    public function destroy($id) {
        $user = User::find($id);
        if(isset($user)) {
            $user->delete();
        }
        return redirect('/administrator/list');
    }
}
