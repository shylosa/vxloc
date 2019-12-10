<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Country;
use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the phonebook
     *
     * @return Factory|View
     */
    public function index()
    {
        $contacts = Contact::whereNotNull('firstname')->whereNotNull('lastname')->get();

        return view('phonebook.index', ['contacts' => $contacts]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $contact = $user->contact->toArray();

        return view('phonebook.show', [
            'contact'     => $contact,
            'phones'      => $user->contact->phones,
            'emails'      => $user->contact->emails,
            'userCountry' => $user->contact->country->country_name
        ]);
    }

    public function mycontact()
    {
        $user = Auth::user();
        $contact = $user->contact->toArray();

        return view('phonebook.mycontact', [
            'contact'     => $contact,
            'phones'      => $user->contact->phones,
            'emails'      => $user->contact->emails,
            'userCountry' => $user->contact->country->country_name,
            'countries'   => Country::all()->pluck('country_name', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'zipcode'   => 'required',
            'phone'     => 'required|array|min:1',
            'phone.*'   => 'required|string|distinct|min:10',
            'phone_status' => 'required|array|min:1',
            'email'        => 'required|array|min:1',
            'email.*'      => 'required|email',
            'email_status' => 'required|array|min:1'
        ]);

        if (!$validator->fails()) {
            $user = Auth::user();
            $user->edit($request->all());
            $user->contact->editContact($request->all());
            $user->contact->setPhones($request->input('phone'), $request->input('phone_status'), $user->id);
            $user->contact->setEmails($request->input('email'), $request->input('email_status'), $user->id);

            return redirect()->back()->with('status', 'Contact updated!');
        }

        return redirect()->back()->with('status', 'Some fields contain errors!');
    }
}
