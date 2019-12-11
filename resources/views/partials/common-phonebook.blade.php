<div>
  <ol>
    @foreach($contacts as $contact)
      <li>{{ $contact->firstname }} {{ $contact->lastname }}
        <a href="{{ route('show', $contact->id) }}">view details</a></li>
    @endforeach
  </ol>
</div>