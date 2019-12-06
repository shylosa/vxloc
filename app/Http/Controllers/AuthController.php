<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('pages.login');
    }

    public function register(Request $request)
    {
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login');
    }

    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
        }

        $user = User::where('name', $request->input('name'))->first();
        if ($user === null) {
            $this->register($request);
        }

        if(Auth::attempt([
            'name'	=>	$request->get('name'),
            'password'	=>	$request->get('password')
        ]))
        {
            return redirect('/');
        }

        return redirect()->back()->with('status', 'Неправильный логин или пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
