<div>
  <ol>
    @foreach($contacts as $contact)
      <li>{{ $contact->firstname }} {{ $contact->lastname }}
        <span>
          <a class="js-link" data-toggle="collapse" href="{{ route('show', $contact->id) }}"
             data-target="#collapse-view-details-{{ $contact->id }}" role="button" aria-expanded="false"
             aria-controls="collapse-view-details-{{ $contact->id }}">view details</a>
        </span>
        <div class="collapse" id="collapse-view-details-{{ $contact->id }}">
          <div class="row">
            <div class="col-sm">
              <span><u>Address</u></span>
              <div>{{ $contact->address }}</div>
              <div>{{ $contact->zipcode }}</div>
              <div>{{ $contact->country->country_name }}</div>
            </div>
            <div class="col-sm">
              <span><u>Phones</u></span>
              @foreach($contact->phones as $phone)
                <div>{{ $phone->phone }}</div>
              @endforeach
            </div>
            <div class="col-sm">
              <span><u>Emails</u></span>
              @foreach($contact->emails as $email)
                <div>{{ $email->email }}</div>
              @endforeach
            </div>
          </div>
        </div>
      </li>
    @endforeach
  </ol>
</div>