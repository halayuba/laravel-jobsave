<template>
  <div class="w-full flex justify-around sm:justify-end items-center sm:px-2 mt-4 sm:mt-0">

    <!-- UNSUCCESSFUL -->
    <a href="#" title="Update as unsuccessful"
      @click.prevent="notSuccessful"
      v-if="submission.status != 'Unsuccessful'"
    >
      <icon name="thumb-down" class="w-5 h-5 mt-1 fill-current text-gray-700" />
    </a>

    <picture
      v-if="submission.status == 'Unsuccessful'"
    >
      <icon name="thumb-down-filled" class="w-5 h-5 mt-1 fill-current text-red-800" />
    </picture> <!-- UNSUCCESSFUL -->

    <!-- RECORD AN INTERVIEW: IF SUBMISSION IS UNSUCCESSFUL DO NOT SHOW -->
    <picture href="#" class="ml-2 cursor-pointer" title="Record Interview"
        @click="recordInterview"
        v-if="recordAnInterviewCondition"
      >
      <icon name="handshake" class="w-8 h-8 fill-current text-indigo-600" />
    </picture>

    <!-- EDIT -->
    <picture class="ml-2 cursor-pointer"
      @click="editSubmission"
    >
      <icon name="edit2" class="w-5 h-auto fill-current text-yellow-700"/>
    </picture>

    <!-- DELETE -->
    <picture class="ml-2 cursor-pointer"
      @click="remove(submission.id)"
    >
      <icon name="delete2" class="w-5 h-auto fill-current text-red-500"/>
    </picture>

  </div>
</template>

<script>
import { mapActions } from 'vuex'

  export default {
    data() {
      return {
      }
    },
    props: {
      submission: { required: true }
    },
    computed:{
      /* == SUBMISSION HAS AN UPCOMING INTERVIEW == */
      hasNoUpcomingInterview(){
        return this.submission.interviews[0].status !== 'Upcoming'
      },
      /* == SUBMISSION NOT UNSUCCESSFUL == */
      submissionNotUnsuccessful(){
        return this.submission.status !== 'Unsuccessful'
      },
      /* == RECORD AN INTERVIEW IF: SUBMISSION NOT UNSUCCESSFUL | SUBMISSION HAS AN UPCOMING INTERVIEW == */
      recordAnInterviewCondition(){
        if(this.submission.interviews && this.submission.interviews.length){
          return this.submissionNotUnsuccessful && this.hasNoUpcomingInterview
        } else {
          return this.submissionNotUnsuccessful
        }
      }

    },
    methods: {
      ...mapActions({
        updateJobSubmission: 'jobs/updateJobSubmission',
        removeJobSubmission: 'jobs/removeJobSubmission',
        updateNotSuccessful: 'jobs/updateNotSuccessful',
      }),
      // edit(submissionId){
      //   this.$emit('editsubmission', submissionId)
      // },
      remove(submissionId){
        if(!confirm("Are you sure?")){
          return
        }
        this.removeJobSubmission(submissionId)
          .then(response => {
            this.$toastr.s('Deleted successfully')
          })
          .catch(error => {
            this.$toastr.e('Delete failed')
          })
      },
      notSuccessful(){
        this.updateNotSuccessful(this.submission.id)
        .then(response => {
            this.$toastr.s('Updated successfully')
          })
          .catch(error => {
            this.$toastr.e('Update failed')
          })
      },
      recordInterview(){
        this.$emit('recordInterview', this.submission.id)
        // console.log(this.submission.id)
        // this.$modal.show('add-interview-modal')
      },
      editSubmission(){
        this.$emit('editSubmission', this.submission)
      },

    },
    mounted() {

    }
  }
</script>
