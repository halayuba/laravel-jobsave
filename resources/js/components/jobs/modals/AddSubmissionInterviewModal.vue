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

        <!-- JOB SUBMISSION -->
        <div class="w-full mt-2 sm:mt-4">
          <label class="form_label">Job submission</label>
          <select
            class="w-full bg-gray-100 text-gray-900 border border-gray-300 rounded px-3 py-3"
            v-model="form.submissionId"
          >
            <option value="">- Select from these submissions</option>
            <option
              v-for="submission in submissions"
              :key="submission.id"
              :value="submission.id"
            >
              {{ submission.company.substr(0, 25) + ' / ' + submission.position.substr(0, 25) }}
            </option>
          </select>
        </div> <!-- JOB SUBMISSION -->

        <!-- SECOND: TWO COLUMNS -->
        <div class="flex flex-col lg:flex-row mt-4">

          <!-- DATE OF INTERVIEW -->
          <div class="w-full mt-2 lg:mt-0">
            <label class="form_label">Interview date</label>
            <input type="date" class="form_input"
              v-model="form.date"
              @change="dateSelected"
              :class="validDate ? 'form_input' : 'form_input_error'"
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
import dayjs from 'dayjs'

export default {
  data () {
    return {
      showInfoMsgFlag: '',
      validDate: true,
      errors: [],
      form: {
        date: '',
        time: '',
        interviewer: '',
        url: '',
        notes: '',
        submissionId: ''
      }
    }
  },
  props: {
    submissions: { required: true }
  },
  components: {
    ErrorAlert
  },
  computed: {
    formCanBeSubmitted () {
      return (this.form.date && this.form.time && this.form.submissionId) ? true : false
    },
    btnState () {
      return {
        'pointer-events-none btn_cancel opacity-25': !this.formCanBeSubmitted,
        'btn_wide': this.formCanBeSubmitted,
      }
    },
    errorsExist () {
      return this.errors ? this.errors.length > 0 : null
    },
    /* == MUST NOT ALLOW TO "COMPLETE" THE INTERVIEW PRIOR TO THE INTERVIEW DATE == */
    dateValidation(){
      if(this.form.date) return dayjs().isBefore(dayjs(this.form.date))
      else return false
    },
  },
  methods: {
    ...mapActions({
      storeInterviewDetail: 'jobs/storeInterviewDetail',
    }),
    formSubmit () {
      if ( this.formCanBeSubmitted && this.dateValidation ) {
        this.storeInterviewDetail({
          submissionId: this.form.submissionId,
          payload: this.form
        })
          .then(response => {
            if(response.data.success){
                this.$toastr.s(response.data.message)
              } else {
                this.$toastr.e(response.data.message)
              }
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
      this.form.submissionId = ''
      this.$modal.hide('add-submission-interview-modal')
    },
    cancelForm () {
      this.closeForm()
      this.$toastr.i('Form cancelled.')
    },
    dateSelected(){
      if(dayjs().isAfter(dayjs(this.form.date))){
        this.errors = []
        this.errors.push('Wrong Date: upcoming interviews must be in the future.')
        this.form.date = ''
        this.validDate = false
      } else {
        this.errors = []
        this.validDate = true
      }
    }

  },

}
</script>
