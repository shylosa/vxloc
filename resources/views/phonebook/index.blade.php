@extends('layout')

@section('content')
  <div>
    <ol>
      @foreach($contacts as $contact)
        <li>{{ $contact->firstname }} {{ $contact->lastname }}
          <a href="{{ route('phonebook.show', $contact->id) }}">view details</a></li>
      @endforeach
    </ol>
  </div>
@endsection
