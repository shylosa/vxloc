@extends('layout')

@section('content')
    <div>
        <ol>
            @foreach($users as $user)
                <li>{{$user->name}} {{$user->lastname}} <a href="{{route('phonebook.show', $user->id)}}">view details</a></li>

            @endforeach
        </ol>
    </div>
@endsection
