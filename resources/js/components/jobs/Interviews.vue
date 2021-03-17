<template>
  <div class="px-2 md:container md:mx-auto md:px-4 xl:px-8">
    <!-- SUMMARY -->
    <submissions-summary />

    <div class="mt-6 md:mt-8 xl:mt-12 flex flex-col xl:flex-row xl:justify-between xl:items-center">

      <!-- ADD NEW JOB INTERVIEW -->
      <AddNewInterviewBtn />
    </div>

    <div class="flex flex-col sm:flex-row flex-wrap sm:space-x-4 lg:space-x-5 xl:space-x-6 p-4">

      <interview class=""
        v-for="interview in interviews"
        :key="interview.id"
        v-if="interviews.length"
        :interview="interview"
        @editInterview="displayEditInterviewModal"
      />

    </div>

    <!-- MODAL: EditSubmissionInterviewModal -->
    <modal name="edit-submission-interview-modal" :adaptive="true" width="90%" :maxWidth="650" height="auto">
      <edit-submission-interview-modal
        :interview="interviewRecord"
      />
    </modal> <!-- MODAL -->

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import SubmissionsSummary from './partials/SubmissionsSummary'
import AddNewInterviewBtn from './partials/AddNewInterviewBtn'
import Interview from './Interview'
import EditSubmissionInterviewModal from './modals/EditSubmissionInterviewModal'
// import moment from 'moment'

  export default {
    data() {
      return {
        interviewRecord: ''
      }
    },
    components:{
      SubmissionsSummary,
      AddNewInterviewBtn,
      Interview,
      EditSubmissionInterviewModal
    },
    computed: {
      ...mapGetters({
        interviews: 'jobs/interviews',
      })
    },
    methods: {
      ...mapActions({
        // getJobSubmissions: 'jobs/getJobSubmissions',
        getJobInterviews: 'jobs/getJobInterviews',
      }),
      displayEditInterviewModal(val){
        // console.log(val)
        this.interviewRecord = val
        this.$modal.show('edit-submission-interview-modal')
      }
    },
    mounted() {
      // this.getJobSubmissions()
      this.getJobInterviews()
      // console.log(this.interview.date)
      // var d = new Date(this.interview.date)
      // console.log(d.getDate())
      // d.getHours();
      // console.log(moment().local())
      // console.log(moment().utcOffset(this.interview.time))
      // console.log(moment().format())
    }
  }
</script>
