@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <span><u>Address</u></span>
                <div>{{ $address }}</div>
                <div>{{ $zipcode }}</div>
                <div>{{ $userCountry }}</div>
            </div>
            <div class="col-sm">
                <span><u>Phones</u></span>
                @foreach($phones as $phone)
                    <div>{{ $phone->phone }}</div>
                @endforeach
            </div>
            <div class="col-sm">
                <span><u>Emails</u></span>
                @foreach($emails as $email)
                    <div>{{ $email->email }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
