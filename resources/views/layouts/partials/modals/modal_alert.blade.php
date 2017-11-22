<alert-modal
    v-show="showModal"
    @close="showModal=false"
 >
  <h2 slot="header">Notes</h2>
  Required fields are marked with green border
  <div slot="footer">
    <a class="button is-success"
      @click="showModal=false"
    >OK</a>
  </div>
</alert-modal>
