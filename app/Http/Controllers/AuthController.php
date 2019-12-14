<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Eloquent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;

/**
 * Authentication class
 *
 * Class AuthController
 * @package App\Http\Controllers
 * @mixin Eloquent
 */
class AuthController extends Controller
{
    /**
     * Displays login form
     *
     * @param Request $request
     * @return Factory|View
     */
    public function loginForm(Request $request)
    {
        return ($request->ajax()) ?
            view('partials.login-form') :
            view('auth.login');
    }

    /**
     * Registration new user
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function register(Request $request)
    {
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login');
    }

    /**
     * Login user on site
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
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

        if (Auth::attempt([
            'name' => $request->get('name'),
            'password' => $request->get('password')
        ])) {
            return redirect('/');
        }

        return redirect()->back()->with('status', 'Wrong password!');
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return ($request->ajax()) ?
            redirect('/login') :
            redirect('/');

    }
}
