<div class="modal is-active"
  v-show="formModal"
>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
      <button class="delete"
        @click="formModal=false"
      ></button>
    </header>
    <section class="modal-card-body">
      <p>form will go here</p>
    </section>
    <footer class="modal-card-foot">
      <a class="button is-success">Save changes</a>
      <a class="button"
        @click="formModal=false"
      >Cancel</a>
    </footer>
  </div>
</div>
