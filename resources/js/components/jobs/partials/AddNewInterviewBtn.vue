<template>
  <div class="mt-2 w-full">
    <div class="w-full xl:mt-0 flex justify-end">
      <a
        href="#"
        class="flex justify-center items-center inline-block px-6 py-4 leading-none bg-gray-800 hover:bg-gray-700 text-sm font-medium text-white rounded"
        @click.prevent="$modal.show('add-submission-interview-modal')"
        :class="btnState"
      >
        {{ btnLabel }}
      </a>
    </div> <!-- ADD NEW Resource -->

    <!-- MODAL -->
    <modal
      name="add-submission-interview-modal"
      :adaptive="true"
      width="90%"
      :maxWidth="650"
      height="auto"
    >
      <add-submission-interview-modal :submissions="filteredSubmissions" />
    </modal> <!-- MODAL -->
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import AddSubmissionInterviewModal from '../modals/AddSubmissionInterviewModal'

export default {
  data () {
    return {

    }
  },
  components: {
    AddSubmissionInterviewModal,
  },
  computed: {
    ...mapGetters({
      filteredSubmissions: 'jobs/filteredSubmissions',
      auth: 'auth/auth'
    }),
    requirement () {
      return this.filteredSubmissions.length && this.auth
    },
    btnState () {
      return {
        'pointer-events-none opacity-25': !this.requirement
      }
    },
    btnLabel () {
      return this.requirement ? 'Add Interview Details' : 'No interviews can be added'
    }
  },
  methods: {
    ...mapActions({
      userAuth: 'auth/userAuth'
    })
  },
  mounted () {

    this.userAuth()
      .then(response => {
        if (!this.filteredSubmissions) {
          this.$toastr.i('There are no job submissions and therefore you can\'t set up an interview. Start by adding a job submission.')
        }
      })
      .catch(error => {
        if (error.response.status === 401) {
          this.$toastr.e("You are not signed in or not authorized to perform actions.")
        }
      })
  }
}
</script>
