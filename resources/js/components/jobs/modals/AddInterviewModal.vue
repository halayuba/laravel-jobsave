<template>
  <div class="px-2 lg:px-4 xl:px-8">

    <!-- ALERT COMPONENTS -->
    <ErrorAlert
      v-if="errorsExist"
      :errors="errors"
    />

    <h3 class="text-center my-2 lg:my-4 md:text-xl lg:text-2xl text-indigo-500 font-bold">Add Interview Detail</h3>

    <!-- FORM -->
    <form
      class="p-4"
      @submit.prevent="formSubmit"
    >

      <!-- FORM FIELDS CONTAINER -->
      <div class="w-full flex flex-col">

        <div class="flex flex-col lg:flex-row mt-2">

          <!-- DATE OF INTERVIEW -->
          <div class="w-full mt-2 lg:mt-0">
            <label class="form_label">Interview date</label>
            <input
              type="date"
              class="form_input"
              v-model="form.date"
            >
          </div>

          <!-- TIME OF INTERVIEW -->
          <div class="w-full mt-2 lg:mt-0 lg:ml-3">
            <label class="form_label">Interview time</label>
            <input
              type="time"
              class="form_input"
              v-model="form.time"
            >
          </div> <!-- TIME OF INTERVIEW -->

        </div>

        <!-- INTERVIEWER -->
        <div class="w-full mt-2 sm:mt-4">
          <label class="form_label">Interviewer(s)</label>
          <input
            type="text"
            class="form_input"
            v-model="form.interviewer"
          >
        </div> <!-- INTERVIEWER -->

        <!-- URL -->
        <div class="w-full mt-2 sm:mt-4">
          <label class="form_label">Interview Link</label>
          <input
            type="url"
            class="form_input"
            placeholder="URL"
            v-model="form.url"
          >
        </div> <!-- URL -->

        <!-- NOTES ABOUT THE INTERVIEW -->
        <div class="w-full mt-2 sm:mt-4">
          <label class="form_label">Notes</label>
          <textarea
            class="form_textarea resize-none"
            rows="3"
            v-model="form.notes"
          ></textarea>
        </div> <!-- NOTES ABOUT THE INTERVIEW -->

      </div> <!-- FORM FIELDS CONTAINER -->

      <!-- BUTTONS -->
      <div class="flex mt-12">

        <!-- CANCEL -->
        <button
          class="flex-1 btn_cancel mr-2"
          type="button"
          @click="cancelForm"
        >Cancel</button>

        <!-- SAVE -->
        <button
          type="submit"
          class="flex-1 xl:text-xl xl:px-16"
          :class="btnState"
        >Save</button>

      </div> <!-- END BUTTONS -->

    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import ErrorAlert from '@/misc/ErrorAlert'

export default {
  data () {
    return {
      showInfoMsgFlag: '',
      errors: [],
      form: {
        date: '',
        time: '',
        interviewer: '',
        url: '',
        notes: ''
      }
    }
  },
  props: {
    submissionId: { required: true }
  },
  components: {
    ErrorAlert
  },
  computed: {
    formEditIsReady () {
      return (this.form.date && this.form.time) ? true : false
    },
    btnState () {
      return {
        'pointer-events-none btn_cancel opacity-25': !this.formEditIsReady,
        'btn_wide': this.formEditIsReady,
      }
    },
    errorsExist () {
      return this.errors ? this.errors.length > 0 : null
    },

  },
  methods: {
    ...mapActions({
      storeInterviewDetail: 'jobs/storeInterviewDetail',
    }),
    formSubmit () {
      if (this.formEditIsReady) {
        this.storeInterviewDetail({
          submissionId: this.submissionId,
          payload: this.form
        })
          .then(response => {
            this.$toastr.s('Created successfully')
            this.closeForm()
          })
          .catch(error => {
            this.flashErrors(error.response.data.errors)
            this.$toastr.e(error.response.data.message)
          })
      } else {
        this.$toastr.e('Missing required fields.')
      }
    },
    flashErrors (errors) {
      for (const [key, value] of Object.entries(errors)) {
        for (let item in value) {
          if (value[item]) this.errors.push(value[item])
        }
      }
    },
    closeForm () {
      this.form.date = ''
      this.form.time = ''
      this.form.interviewer = ''
      this.form.url = ''
      this.form.notes = ''
      this.$modal.hide('add-interview-modal')
    },
    cancelForm () {
      this.closeForm()
      this.$toastr.i('Form cancelled.')
    },

  },
  mounted () {

  }

}
</script>
