<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Country;
use App\Email;
use App\Phone;
use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the phonebook
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $contacts = Contact::whereNotNull('firstname')->whereNotNull('lastname')->get();
        $fields = ['contacts' => $contacts];

        return ($request->ajax()) ?
            view('partials.common-phonebook', $fields) :
            view('phonebook.index', $fields);
    }

    public function mycontact()
    {
        $user = Auth::user();
        if ($user) {
            //Initialize record in table for new model
            Phone::firstOrCreate(['contact_id' => $user->contact->id]);
            Email::firstOrCreate(['contact_id' => $user->contact->id]);
        }
        $contact = $user->contact->toArray();

        //@TODO Make correct preservation of old field values in case of validation errors

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
            $contactId = $user->contact->id;
            $user->contact->editContact($request->all());
            $user->contact->setPhones($request->input('phone'), $request->input('phone_status'), $contactId);
            $user->contact->setEmails($request->input('email'), $request->input('email_status'), $contactId);

            return redirect()->back()->with('status', 'Contact updated!');
        }

        return redirect()->back()->withErrors($validator);
        //return redirect()->back()->with('status', 'Some fields contain errors!')->withErrors($validator);
    }
}
