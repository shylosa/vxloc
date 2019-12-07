@extends('layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md">
        <div class="card">
          <div class="card-header">{{ __('My contact') }}</div>
          <div class="card-body">
            @if(session('status'))
              <div class="alert alert-danger">
                {{session('status')}}
              </div>
            @endif

            <form method="POST" action="{{ route('phonebook.mycontact') }}">
              @csrf

              <div class="row">

                <div id="contact" class="col-sm text-md-center">
                  <label for="contact" class="col-form-label"><u>{{ __('Contact') }}</u></label>
                  <div class="form-group row">
                    <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>
                    <div class="col-md">
                      <input id="firstname" type="text"
                             class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                             value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                      @error('firstname')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>
                    <div class="col-md">
                      <input id="lastname" type="text"
                             class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                             value="{{ old('lastname') }}" required autocomplete="lastname">
                      @error('lastname')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                    <div class="col-md">
                      <input id="address" type="text"
                             class="form-control @error('address') is-invalid @enderror" name="address"
                             value="{{ old('address') }}" required autocomplete="address">
                      @error('address')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('ZIP/City') }}</label>
                    <div class="col-md">
                      <input id="zipcode" type="text"
                             class="form-control @error('zipcode') is-invalid @enderror" name="zipcode"
                             value="{{ old('zipcode') }}" required autocomplete="zipcode">
                      @error('zipcode')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                    <div class="col-md">
                      <input id="country" type="text"
                             class="form-control @error('country') is-invalid @enderror" name="country"
                             value="{{ old('zipcode') }}" required autocomplete="zipcode">
                      @error('country')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div id="phones" class="col-sm text-md-center">
                  <label for="phones" class="col-form-label"><u>{{ __('Phones') }}</u></label>
                  <div class="form-group row">
                    <div class="col-md">
                      <input type="text"
                             class="form-control @error('phone') is-invalid @enderror" name="phone"
                             value="{{ old('phone') }}" required autocomplete="phone">
                      @error('phone')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="col-md-1">
                      <input class="form-check-input" type="checkbox">
                    </div>
                  </div>

                    <a href="/" class="col-md-4 float-right">Add</a>

                </div>


                <div id="emails" class="col-sm text-md-center">
                  <label for="emails" class="col-form-label"><u>{{ __('Emails') }}</u></label>
                  <div class="form-group row">
                    <div class="col-md">
                      <input type="text"
                             class="form-control @error('phone') is-invalid @enderror" name="email"
                             value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="col-md-1">
                      <input class="form-check-input" type="checkbox">
                    </div>
                  </div>
                  <a href="/" class="col-md-4 float-right">Add</a>
                </div>

              </div>

              <div class="form-group row mb-0 justify-content-end">
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary col-md">
                    {{ __('Save') }}
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
