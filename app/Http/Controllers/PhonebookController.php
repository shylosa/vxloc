<?php

namespace App\Http\Controllers;

use App\Email;
use App\Phone;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the phonebook
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::all();

        return view('phonebook.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $phones = $user->phones;
        $emails = $user->emails;

        return view('phonebook.show', [
            'user' => $user,
            'phones' => $phones,
            'emails' => $emails
        ]);
    }
}
