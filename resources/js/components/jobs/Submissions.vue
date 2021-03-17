<template>
  <div class="px-2 md:container md:mx-auto md:px-4 xl:px-8">

    <!-- SUBMISSION FORM -->
    <submission-form />

    <!-- SUMMARY -->
    <submissions-summary />

    <!-- SEARCH FIELD -->
    <div class="my-4">
      <SearchInput
        @captured="quickSearch"
        @clearSearch="clearSearch"
      />
    </div>

    <div class="mt-4 bg-gray-300 p-4">

      <!-- TABLE HEADER -->
      <table-header class="hidden sm:flex" />

      <!-- CONTENT -->
      <div class="mt-4 bg-gray-100 p-2 shadow-cc">
        <div class="flex pb-2 hover:bg-gray-200"
          v-for="submission, index in result"
          :key="submission.id"
          v-if="result.length"
          :class="[ index === result.length - 1 ? '' : 'border-b border-gray-200' ]"
        >
          <div class="flex flex-col sm:flex-row w-full">

            <submission :submission="submission" />

            <!-- ACTIONS -->
            <div class="mt-2 w-full sm:w-1/6">
              <actions
                :submission="submission"
                @recordInterview="displayInterviewModal"
                @editSubmission="displayEditSubmissionModal"
              />
            </div>
          </div>

        </div>

        <div class="alert-no-records"
          v-else
        >
          There are no submissions to display
        </div>

        <!-- MODAL: AddInterviewModal -->
        <modal name="add-interview-modal" :adaptive="true" width="90%" :maxWidth="650" height="auto">
          <AddInterviewModal :submissionId="submissionId" />
        </modal> <!-- MODAL -->

        <!-- MODAL: EditSubmissionFormModal -->
        <modal name="edit-submission-form-modal" :adaptive="true" width="90%" :maxWidth="650" height="auto">
          <EditSubmissionFormModal :submission="submissionRecord" />
        </modal> <!-- MODAL -->

      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Actions from './Actions'
import Submission from './Submission'
import SubmissionForm from './partials/SubmissionForm'
import SubmissionsSummary from './partials/SubmissionsSummary'
import SearchInput from './partials/SearchInput'
import TableHeader from './partials/TableHeader'
import AddInterviewModal from './modals/AddInterviewModal'
import EditSubmissionFormModal from './modals/EditSubmissionFormModal'

  export default {
    data() {
      return {
        result: '',
        submissionId: '',
        submissionRecord: ''
      }
    },
    props: {
      jobsubmissions: { required: true }
    },
    components:{
      Actions,
      SubmissionForm,
      SubmissionsSummary,
      SearchInput,
      AddInterviewModal,
      EditSubmissionFormModal,
      TableHeader,
      Submission
    },
    computed: {
      ...mapGetters({
        submissions: 'jobs/submissions'
      }),

    },
    methods: {
      ...mapActions({
        getJobSubmissions: 'jobs/getJobSubmissions',
      }),
      quickSearch(val) {
        /* == PERFORM IF THERE ARE RECORDS TO SEARCH THROUGH IN THE FIRST PLACE == */
        if(this.result){
          let value = this.captureSearchValue(val)
          this.setList(this.result.filter(item => {
            return (
              ( item.company.toLowerCase().includes(value) ) ||
              ( item.location.toLowerCase().includes(value) )
            )
          }))
        } else {
          this.$toastr.w('There are currently no records to perform any search on.')
        }
      },
      captureSearchValue(value) {
        if( value && value.trim().length > 0) {
          return value.trim().toLowerCase()
        }
        else this.clearSearch()
      },
      setList(filtered) {
        this.result = ''
        if(filtered.length){
          this.result = filtered
        } else {
          this.$toastr.i('No records found for the selected criteria.')
        }
      },
      clearSearch() {
        this.getJobSubmissions()
        this.result = this.submissions
      },
      refreshSubmissions(){
        this.getJobSubmissions()
          .then(response => {
            this.result = this.submissions
          })
      },
      displayInterviewModal(val){
        this.submissionId = val
        this.$modal.show('add-interview-modal')
      },
      displayEditSubmissionModal(val){
        this.submissionRecord = val
        this.$modal.show('edit-submission-form-modal')
      },

    },
    mounted() {
      if( this.jobsubmissions.length == 0 || this.jobsubmissions.length == null ){
        this.$toastr.w('No records found.')
      } else {
        this.refreshSubmissions()
        // this.result = this.jobsubmissions
      }

    },
    watch:{
      submissions(){
        this.result = this.submissions
      }
    }
  }
</script>
