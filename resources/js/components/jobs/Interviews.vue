<template>
  <div class="px-2 md:container md:mx-auto md:px-4 xl:px-8">
    <!-- SUMMARY -->
    <submissions-summary />

    <div class="mt-6 md:mt-8 xl:mt-12 flex flex-col xl:flex-row xl:justify-between xl:items-center">

      <!-- ADD NEW JOB INTERVIEW -->
      <AddNewInterviewBtn />
    </div>

    <div
      class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 sm:gap-2"
      v-if="interviews.length"
    >
      <interview
        v-for="interview in interviews"
        :key="interview.id"
        :interview="interview"
        :auth="auth"
        @editInterview="displayEditInterviewModal"
      />
    </div>

    <!-- MODAL: EditSubmissionInterviewModal -->
    <modal
      name="edit-submission-interview-modal"
      :adaptive="true"
      width="90%"
      :maxWidth="650"
      height="auto"
    >
      <edit-submission-interview-modal :interview="interviewRecord" />
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
  data () {
    return {
      interviewRecord: ''
    }
  },
  components: {
    SubmissionsSummary,
    AddNewInterviewBtn,
    Interview,
    EditSubmissionInterviewModal
  },
  computed: {
    ...mapGetters({
      interviews: 'jobs/interviews',
      auth: 'auth/auth'
    })
  },
  methods: {
    ...mapActions({
      userAuth: 'auth/userAuth',
      // getJobSubmissions: 'jobs/getJobSubmissions',
      getJobInterviews: 'jobs/getJobInterviews',
    }),
    displayEditInterviewModal (val) {
      this.interviewRecord = val
      this.$modal.show('edit-submission-interview-modal')
    }
  },
  mounted () {
    this.userAuth()
    this.getJobInterviews()
  }
}
</script>
