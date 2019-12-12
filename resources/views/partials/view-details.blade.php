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