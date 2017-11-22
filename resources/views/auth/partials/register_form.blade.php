<section class="mgt_3">

    <form id="form" action="{{ route('register') }}" method="post">
      {{csrf_field()}}

      <div class="field">
        <p class="control has-icon">
          <input name="name" class="input is-large" type="text" value="{{ old('name') }}" placeholder="What's your full name" required
            @focusin="removeMsg('name')"
          >
          <span class="icon">
            <i class="ion-person"></i>
          </span>
        </p>
      </div>

      <div class="field">
        <p class="control has-icon">
          <input name="email" class="input is-large{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" value="{{ old('email') }}" placeholder="What's your email address" required>
          <span class="icon">
            <i class="ion-email"></i>
          </span>
        </p>
      </div>

      <div class="field">
        <p class="control has-icon">
          <input name="password" class="input is-large" type="password" placeholder="Choose a password with 6 characters" required>
          <span class="icon">
            <i class="ion-locked"></i>
          </span>
        </p>
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
          <button class="button is-large is_color8 is-fullwidth">Register</button>
        </p>
      </div>

    </form>

</section>
