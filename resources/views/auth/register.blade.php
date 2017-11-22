@extends('layouts.master_NoSideNav')

@section('content')

  <div class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <div class="content">
            <h1 class="title is-1 has-text-centered">
              Register
            </h1>
            <div class="border_center"></div>

            @include('auth.partials.register_form')

            <p class="subtitle mgt_1 is-6 has-text-centered">
              Already have an account?
              <a href="{{route('login')}}">Click to Sign In</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
