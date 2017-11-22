@extends('layouts.master_NoSideNav')

@section('content')

  <div class="section">
   <div class="container is-fluid">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          @if (session('status'))
              <div class="notification is-info">
                  {{ session('status') }}
              </div>
          @endif

          <div class="content">
            <h1 class="title is-1 has-text-centered">
              Reset Password
            </h1>
            <div class="border_center"></div>

            <form action="{{ route('password.email') }}" method="post" class="form">
                {{ csrf_field() }}

                <div class="field">
                    <p class="control">
                        <input type="email" name="email" id="email" placeholder="Type your email address to receive a link" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ old('email') }}" required>
                    </p>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                <div class="field">
                    <p class="control">
                      <button class="button is-large is_color8 is-fullwidth">Send email</button>
                    </p>
                </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
