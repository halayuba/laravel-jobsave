@extends('layouts.master_NoSideNav')

@section('content')

  <div class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <div class="content">
            <h1 class="title is-1 has-text-centered">
              Log in
            </h1>
            <div class="border_center"></div>

            @include('auth.partials.login_form')

              <div class="field has-text-centered">
                <div class="mgt_1">
                  <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div>
                <div class="mgt_1">
                  <a href="{{ route('register') }}">Register now</a>
                </div>
                <div class="mgt_1">
                  <a href="{{ route('auth.activation.resend') }}">Resend activation email</a>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
