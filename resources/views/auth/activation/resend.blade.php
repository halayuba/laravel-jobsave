@extends('layouts.master_NoSideNav')

@section('content')

  <div class="section mgb_8">
   <div class="container is-fluid">
      <div class="columns">
        <div class="column is-4 is-offset-4">

          <div class="content">
            <h1 class="title is-1 has-text-centered">
              Resend Activation Email
            </h1>
            <div class="border_center"></div>

            <form action="{{ route('auth.activation.resend') }}" method="post" class="form">
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
                      <button class="button is-large is_color8 is-fullwidth">Resend</button>
                    </p>
                </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
