@extends('layouts.master_NoSideNav')

@section('content')

  <div class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <div class="content">
            <h1 class="title is-1 has-text-centered">
              Choose a new password
            </h1>
            <div class="border_center"></div>

            <section class="mgt_1">
              <form action="{{ route('password.request') }}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                  <p class="control has-icon">
                    <input name="email" type="email" class="input is-large{{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ $email or old('email') }}" placeholder="email address" required >
                    <span class="icon">
                      <i class="ion-email"></i>
                    </span>
                  </p>
                  @if ($errors->has('email'))
                    <p class="help is-danger">
                        {{ $errors->first('email') }}
                    </p>
                  @endif
                </div>

                <div class="field">
                  <p class="control has-icon">
                    <input name="password" type="password" class="input is-large" placeholder="Password">
                    <span class="icon">
                      <i class="ion-locked"></i>
                    </span>
                  </p>
                  @if ($errors->has('password'))
                    <p class="help is-danger">
                        {{ $errors->first('password') }}
                    </p>
                  @endif
                </div>

                <div class="field">
                  <p class="control has-icon">
                    <input name="password_confirmation" class="input is-large" type="password" placeholder="Confirm Password" required>
                    <span class="icon">
                      <i class="ion-locked"></i>
                    </span>
                  </p>
                </div>

                <div class="field">
                  <p class="control">
                    <button class="button is-large is_color8 is-fullwidth">Reset Password</button>
                  </p>
                </div>

              </form>
            </section>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
