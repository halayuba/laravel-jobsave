<template>
  <div class="mt-2 w-full">
    <div class="w-full xl:mt-0 flex justify-end">
      <a href="#" class="flex justify-center items-center inline-block px-6 py-4 leading-none bg-gray-800 hover:bg-gray-700 text-sm font-medium text-white rounded"
        @click.prevent="$modal.show('add-submission-interview-modal')"
      >
        Add Interview Details
      </a>
    </div> <!-- ADD NEW Resource -->

    <!-- MODAL -->
    <modal name="add-submission-interview-modal" :adaptive="true" width="50%" height="auto" classes="bg-white rounded-lg p-4 shadow-sm">
      <add-submission-interview-modal :submissions="filteredSubmissions" />
    </modal> <!-- MODAL -->
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import AddSubmissionInterviewModal from '../modals/AddSubmissionInterviewModal'

  export default {
    data() {
      return {

      }
    },
    components:{
      AddSubmissionInterviewModal,
    },
    computed: {
      ...mapGetters({
        filteredSubmissions: 'jobs/filteredSubmissions'
      }),
    },
    methods: {

    },
    mounted() {

    }
  }
</script>
