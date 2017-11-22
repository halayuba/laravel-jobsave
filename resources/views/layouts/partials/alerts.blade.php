@if(session()->has('message'))
  <alert-bulma
    msg="{{ session('message') }}"
    klass="{{ session('state') }}"
    v-show="alertVisible"
    url='false'
  >
  </alert-bulma>
@endif

@if(count($errors))
  <div class="columns"
    v-show="alertVisible"
  >
    <div class="column is-half is-offset-one-quarter">
      <div class="notification is-danger">
        <button class="delete"
          @click="notificationVisible=false"
        ></button>
        {!! loop_errors($errors) !!}
      </div>
    </div>
  </div>
@endif
