<template>
  <div class="px-2 lg:px-4 xl:px-8">

    <!-- ALERT COMPONENTS -->
    <ErrorAlert
      v-if="errorsExist"
      :errors="errors"
    />

    <h3 class="text-center my-2 lg:my-4 md:text-xl lg:text-2xl text-indigo-500 font-bold">Edit Job Submission</h3>

    <!-- FORM -->
    <form class="p-4"
      @submit.prevent="submit"
    >
      <div class="w-full flex flex-col">

        <!-- COMPANY -->
        <input class="mt-2 w-full px-2 py-3 bg-gray-900 rounded-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Company"
          v-model="form.company"
        />

        <!-- LOCATION -->
        <input class="mt-2 w-full px-2 py-3 bg-gray-900 rounded-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Location"
          v-model="form.location"
        />

        <!-- POSITION -->
        <input class="mt-2 w-full px-2 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Position"
          v-model="form.position"
        />

        <!-- URL -->
        <input class="mt-2 w-full px-2 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="URL"
          v-model="form.url"
        />

        <textarea class="mt-2 w-full px-2 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" rows="2" placeholder="Note"
          v-model="form.note"
        ></textarea>

      </div>

      <!-- BUTTONS -->
      <div class="flex mt-12">

        <!-- CANCEL -->
        <button class="flex-1 btn_cancel" type="button"
          @click="cancelForm"
        >Cancel</button>

        <!-- SAVE -->
        <button type="submit" class="flex-1 btn_wide ml-2"
        >Save</button>
      </div> <!-- END BUTTONS -->

    </form>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  import ErrorAlert from '../../misc/ErrorAlert'

  export default {
    data() {
      return {
        errors: [],
        showFlag: '',
        form:{
          company: this.submission.company,
          location: this.submission.location,
          position: this.submission.position,
          url: this.submission.url,
          note: this.submission.note,
        }
      }
    },
    props: {
      submission: { required: true }
    },
    components:{
      ErrorAlert
    },
    computed: {
      ...mapGetters({
        submissions: 'jobs/submissions'
      }),
      formSubmitIsReady(){
        return this.form.company !== '' && this.form.location !== '' && this.form.position !== ''
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
    },
    methods: {
      ...mapActions({
        updateJobSubmission: 'jobs/updateJobSubmission',
      }),
      submit() {
        if ( this.formSubmitIsReady ) {

          this.updateJobSubmission({
            submissionId: this.submission.id,
            payload: this.form
          })
            .then(response => {
              if(response.status === 409){
                this.$toastr.e(response.message)
              } else {
                this.$toastr.s('Updated successfully')
                this.closeForm()
              }
            })
            .catch(error => {
              this.flashErrors(error.response.data.errors)
              this.$toastr.e(error.response.data.message)
            })
        } else {
          this.$toastr.w('Missing required fields.')
        }
      },
      flashErrors(errors) {
        for( const [key, value] of Object.entries(errors)) {
          for(let item in value) {
            if( value[item] ) this.errors.push(value[item])
          }
        }
      },
      closeForm(){
        this.form.company = ''
        this.form.location = ''
        this.form.position = ''
        this.form.url = ''
        this.form.note = ''
        this.showFlag = ''
        this.$modal.hide('edit-submission-form-modal')
      },
      cancelForm() {
        this.closeForm()
        this.$toastr.i('Form cancelled.')
      },
      toggleShowFlag(val = ''){
        this.showFlag = this.showFlag == val ? '' : val
      }
    },
  }
</script>
