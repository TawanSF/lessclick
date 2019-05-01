<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdministratorLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:administrator');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $authOK = Auth::guard('administrator')->attempt($credentials, $request->remember);

        if ($authOK) {
            return redirect()->intended(route('administrator.dashboard'));
        }
        return redirect()->back()->withInputs($request->only('email', 'remember'));

        $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

    }

    public function index() {
        return view('auth.administrator-login');
    }
}
