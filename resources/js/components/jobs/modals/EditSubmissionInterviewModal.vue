<template>
  <div class="px-2 lg:px-4 xl:px-8">

    <!-- ALERT COMPONENTS -->
    <ErrorAlert
      v-if="errorsExist"
      :errors="errors"
    />

    <h3 class="text-center my-4 text-xl lg:text-2xl text-indigo-500 font-bold">Edit Interview Details</h3>

    <!-- FORM -->
    <form class="p-4 overflow-y-scroll"
      @submit.prevent="formSubmit"
    >

    <!-- FORM FIELDS CONTAINER -->
    <div class="w-full flex flex-col">

      <!-- COMPANY / LOCATION -->
      <div class="w-full sm:mt-4 flex items-baseline bg-gray-100 px-2">
        <h3 class="sm:text-2xl text-gray-700 font-semibold leading-loose">{{ interview.submission.company }}</h3>
        <h5 class="text-gray-600 ml-2"> - {{ interview.submission.location }}</h5>
      </div> <!-- COMPANY / LOCATION -->

      <!-- POSITION -->
      <div class="w-full mt-2 text-gray-600 bg-gray-100 px-2 leading-loose">
        {{ interview.submission.position }}
      </div>

      <!-- SECOND: TWO COLUMNS -->
      <div class="flex flex-col lg:flex-row mt-4">

        <!-- DATE OF INTERVIEW -->
        <div class="w-full mt-2 lg:mt-0">
          <label class="form_label">Interview date</label>

          <!-- INITIALLY DISPLAY AS TEXT FIELD -->
          <input type="text" class="form_input"
            @focusin="changeFieldType('date')"
            v-if="inputFiedFlag !== 'date'"
            v-model="form.date"
          />

          <!-- SWITCH TO DATE FIELD ONCE THE ABOVE TEXT FIELD IS CLICKED -->
          <input type="date" class="form_input"
            v-model="form.date"
            v-if="inputFiedFlag == 'date'"
          >
        </div>

        <!-- TIME OF INTERVIEW -->
        <div class="w-full mt-2 lg:mt-0 lg:ml-3">
          <label class="form_label">Interview time</label>

          <!-- INITIALLY DISPLAY AS TEXT FIELD -->
          <input type="text" class="form_input"
            @focusin="changeFieldType('time')"
            v-if="inputFiedFlag !== 'time'"
            v-model="form.time"
          />

          <!-- SWITCH TO TIME FIELD ONCE THE ABOVE TEXT FIELD IS CLICKED -->
          <input type="time" class="form_input"
            v-model="form.time"
            v-if="inputFiedFlag == 'time'"
          >
        </div> <!-- TIME OF INTERVIEW -->

      </div>

      <!-- INTERVIEWER -->
      <div class="w-full mt-2 sm:mt-4">
        <label class="form_label">Interviewer(s)</label>
        <input type="text" class="form_input"
          v-model="form.interviewer"
        >
      </div> <!-- INTERVIEWER -->

      <!-- NOTES ABOUT THE INTERVIEW -->
      <div class="w-full mt-2 sm:mt-4">
        <label class="form_label">Notes</label>
        <textarea class="form_textarea resize-none" rows="3"
          v-model="form.notes"
        ></textarea>
      </div> <!-- NOTES ABOUT THE INTERVIEW -->

      <!-- STATUS -->
      <div class="w-full mt-2 sm:mt-4">
        <label class="form_label">Status</label>
        <div class="w-full flex flex-col sm:flex-row sm:items-center mt-2">
          <div class="w-full flex">
            <div class="flex-grow p-2 border border-gray-300 sm:rounded">
              <input type="radio" id="one" value="Canceled" v-model="form.status">
              <label for="one" class="ml-1 text-gray-700">Canceled</label>
            </div>
            <div class="flex-grow sm:ml-2 p-2 border border-gray-300 sm:rounded">
              <input class="" type="radio" id="two" value="Completed" v-model="form.status">
              <label for="two" class="ml-1 text-gray-700">Completed</label>
            </div>
          </div>
          <div class="w-full mt-2 sm:mt-0 flex">
            <div class="flex-grow sm:ml-2 p-2 border border-gray-300 sm:rounded">
              <input class="" type="radio" id="three" value="Rescheduled" v-model="form.status">
              <label for="three" class="ml-1 text-gray-700">Rescheduled</label>
            </div>
            <div class="flex-grow sm:ml-2 p-2 border border-gray-300 sm:rounded">
              <input class="" type="radio" id="four" value="Upcoming" v-model="form.status">
              <label for="four" class="ml-1 text-gray-700">Upcoming</label>
            </div>
          </div>

        </div>
      </div>

    </div> <!-- FORM FIELDS CONTAINER -->

    <!-- BUTTONS -->
    <div class="flex mt-8 sm:mt-12">

      <!-- CANCEL -->
      <button class="flex-1 btn_cancel mr-2" type="button"
        @click="cancelForm"
      >Cancel</button>

      <!-- SAVE -->
      <button type="submit" class="flex-1 xl:text-xl xl:px-16"
        :class="btnState"
      >Save</button>

    </div> <!-- END BUTTONS -->

    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import ErrorAlert from '../../misc/ErrorAlert'
import moment from 'moment'

export default {
  data () {
    return {
      inputFiedFlag: 'text',
      errors: [],
      form:{
        date: moment(this.interview.date).format("MM-DD-YYYY"),
        time: moment(this.interview.time).format("h:mm a"),
        interviewer: this.interview.interviewer,
        notes: this.interview.notes,
        submissionId: this.interview.submission.id,
        status: this.interview.status
      }
    }
  },
  props: {
    interview: { required: true },
  },
  components:{
    ErrorAlert
  },
  computed: {
    formEditIsReady() {
      return ( this.form.date && this.form.time && this.form.submissionId ) ? true : false
    },
    btnState() {
      return {
        'pointer-events-none btn_cancel opacity-25': ! this.formEditIsReady,
        'btn_wide': this.formEditIsReady,
      }
    },
    errorsExist() {
      return this.errors ? this.errors.length > 0 : null
    },
    interviewDate(){
      return moment(this.interview.date).format("MM-DD-YYYY")
    }
  },
  methods: {
    ...mapActions({
      updateJobInterview: 'jobs/updateJobInterview',
    }),
    formSubmit() {
      /* == WORK AROUND TO BE ABLE TO FORMAT THE "DATE" CORRECTLY BEFORE SUBMITTING THE FORM == */
      if(this.form.date === moment(this.interview.date).format("MM-DD-YYYY")){
        this.form.date = moment(this.interview.date).format("YYYY-MM-DD")
      }
      if ( this.formEditIsReady ) {
        this.updateJobInterview({
          interviewId: this.interview.id,
          payload: this.form
        })
          .then(response => {
            this.$toastr.s('Updated successfully')
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
    flashErrors(errors) {
      for( const [key, value] of Object.entries(errors)) {
        for(let item in value) {
          if( value[item] ) this.errors.push(value[item])
        }
      }
    },
    closeForm() {
      this.form.date = ''
      this.form.time = ''
      this.form.interviewer = ''
      this.form.notes = ''
      this.form.submissionId = ''
      this.$modal.hide('edit-submission-interview-modal')
    },
    cancelForm() {
      this.closeForm()
      this.$toastr.i('Form cancelled.')
    },
    /* == SWITCHING BETWEEN FIELD TYPES "TEXT" & 'DATE' TO BE ABLE TO DISPLAY THE DATE WHEN THE MODAL IS DISPLAYED == */
    changeFieldType(value){
      this.inputFiedFlag = value
    },

  },

}
</script>
