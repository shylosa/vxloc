@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <span>Address</span>
                <div>{{ $user->address }}</div>
            </div>
            <div class="col-sm">
                <span>Phones</span>
                @foreach($phones as $phone)
                    <div>{{ $phone->phone }}</div>
                @endforeach
            </div>
            <div class="col-sm">
                <span>E-mails</span>
                @foreach($emails as $email)
                    <div>{{ $email->email }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
