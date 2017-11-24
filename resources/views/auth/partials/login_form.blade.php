<section class="mgt_1">
  <form action="{{ route('login') }}" method="post">
    {{csrf_field()}}

    <div class="field">
      <p class="control has-icon">
        <input name="email" type="email" class="input is-large{{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ $email or old('email') }}" placeholder="email address" required >
        <span class="icon">
          <i class="fa fa-envelope"></i>
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
          <i class="fa fa-locked"></i>
        </span>
      </p>
      @if ($errors->has('password'))
        <p class="help is-danger">
            {{ $errors->first('password') }}
        </p>
      @endif
    </div>

    <div class="field">
      <p class="control">
        <label class="checkout">
          <input name="remember" type="checkbox" id="remember" checked>
          Remember me
        </label>
      </p>
    </div>

    <div class="field">
      <p class="control">
        <button class="button is-large is_color8 is-fullwidth">Log in</button>
      </p>
    </div>

  </form>
</section>
