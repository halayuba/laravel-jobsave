<template>
  <div class="my-4 p4 w-full shadow">
    <div class="bg-white flex flex-col lg:flex-row items-center py-6 px-4 xl:px-12">
      <div class="w-full sm:flex-1 flex justify-around sm:justify-center sm:flex-col items-center py-2 xl:border-r border-gray-200">
          <span class="uppercase text-sm text-gray-600 text-center">all job submissions / this week</span>
          <span class="uppercase font-semibold text-xl text-gray-800">{{ submissions.length }} / {{ totalSubmissionsThisWeek }}</span>
      </div>
      <div class="w-full sm:flex-1 flex justify-around sm:justify-center sm:flex-col items-center py-2 xl:border-r border-gray-200">
          <span class="uppercase text-sm text-gray-600 text-center">unsuccessful submissions</span>
          <span class="uppercase font-semibold text-xl text-gray-800">{{ unsuccessfulSubmissions }}</span>
      </div>
      <div class="w-full sm:flex-1 flex justify-around sm:justify-center sm:flex-col items-center py-2 xl:border-r border-gray-200">
          <span class="uppercase text-sm text-gray-600 text-center">submissions lead to interviews</span>
          <span class="uppercase font-semibold text-xl text-gray-800">{{ submissionsHaveInterviews }}</span>
      </div>
      <div class="w-full sm:flex-1 flex justify-around sm:justify-center sm:flex-col items-center py-2">
          <span class="uppercase text-sm text-gray-600 text-center">completed / upcoming interviews</span>
          <span class="uppercase font-semibold text-xl text-gray-800">{{ completedInterviews }} / {{ upcomingInterviews }}</span>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    data() {
      return {

      }
    },
    computed: {
      ...mapGetters({
        submissions: 'jobs/submissions',
        upcomingInterviews: 'jobs/upcomingInterviews',
        totalSubmissionsThisWeek: 'jobs/totalSubmissionsThisWeek',
        submissionsHaveInterviews: 'jobs/submissionsHaveInterviews',
        completedInterviews: 'jobs/completedInterviews',
      }),
      unsuccessfulSubmissions(){
        const unsuccessful = this.submissions.filter(item => item.status === 'Unsuccessful')
        return unsuccessful.length
      }
    },
    methods: {
      ...mapActions({
        getJobSubmissions: 'jobs/getJobSubmissions',
      }),
    },
    async mounted() {
      await this.getJobSubmissions()
    }

  }
</script>
