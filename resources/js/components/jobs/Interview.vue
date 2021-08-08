<template>
  <div class="card w-full sm:w-64">

    <!-- COMPANY -->
    <div class="mt-2 flex justify-between items-center">

      <div class="flex items-center">
        <h3 :class="[ interview.status === 'Upcoming' ? 'card_header_current' : 'card_header' ]">{{ interview.submission.company }}</h3>
      </div>

    </div> <!-- COMPANY -->

    <!-- POSITION -->
    <a
      class="mt-6 px-6 text-gray-600 text-xs"
      :href="interview.submission.url"
    >
      {{ interview.submission.position }}
    </a>

    <!-- INTERVIEW ADDITIONAL DETAILS -->
    <div class="flex flex-col mt-4 px-6">

      <!-- INTERVIEWER -->
      <div class="flex items-baseline">
        <icon
          name="users"
          class="w-4 h-4 fill-current text-gray-600"
        />
        <span class="text-gray-700 text-sm tracking-tight ml-2">{{ interview.interviewer }}</span>
      </div>

      <!-- INTERVIEW DATE / TIME -->
      <div class="mt-4 flex items-center">
        <icon
          name="calendar"
          class="w-6 h-6 fill-current text-gray-600 flex-shrink-0"
        />
        <span class="text-gray-700 text-sm tracking-tight ml-1">{{ interview.dateTime }}</span>
      </div>

      <!-- LINK TO INTERVIEW MEETING -->
      <div class="mt-4 flex items-center"
        v-if="interview.url"
      >
        <!-- LINK -->
        <a target="_blank" title="Click to go to Zoom / WebEx / MS Teams meeting"
          :href="interview.url"
        >
          <icon name="link" class="w-6 h-6 fill-current text-gray-600 flex-shrink-0" />
        </a>
      </div>

      <!-- NOTES -->
      <div
        class="mt-4 flex items-center"
        v-if="interview.notes"
      >
        <icon
          name="note"
          class="w-6 h-6 fill-current text-gray-600 flex-shrink-0"
          :title="interview.notes"
        />
        <span class="text-gray-700 text-xs tracking-tight leading-none ml-1 flex-wrap">{{ interview.notes }}</span>
      </div>

      <!-- STATUS -->
      <div class="mt-4 flex items-center">
        <icon
          name="sun"
          class="w-8 h-8 fill-current text-gray-600"
        />
        <span class="text-gray-700 text-sm tracking-tight ml-2">{{ interview.status }}</span>
      </div>

    </div> <!-- INTERVIEW ADDITIONAL DETAILS -->

    <!-- ACTION BUTTONS -->
    <div
      class="mt-4 px-4"
      v-if="auth"
    >
      <div class="pt-4 flex justify-end items-center border-t border-gray-200">

        <!-- CHECK COMPLETED: SHOW ONLY IF STATUS IS UPCOMING -->
        <picture
          class="cursor-pointer"
          v-if="interview.status === 'Upcoming'"
          @click="done(interview.id)"
        >
          <icon
            name="checkbox"
            class="w-5 h-auto fill-current text-green-500"
          />
        </picture>

        <!-- EDIT -->
        <picture
          class="ml-2 cursor-pointer"
          @click="edit"
        >
          <icon
            name="edit2"
            class="w-5 h-auto fill-current text-yellow-700"
          />
        </picture>

        <!-- DELETE -->
        <picture
          class="ml-2 cursor-pointer"
          @click="remove(interview.id)"
        >
          <icon
            name="delete2"
            class="w-5 h-auto fill-current text-red-500"
          />
        </picture>

      </div>
    </div> <!-- ACTION BUTTONS -->

  </div> <!-- CARD -->
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import moment from 'moment'

export default {
  data () {
    return {

    }
  },
  props: {
    interview: { required: true },
    auth: { required: true }
  },
  computed: {
    // ...mapGetters({

    // })
  },
  filters: {
    formatDate (date) {
      if (date) return moment(date).format("MM-DD-YYYY")
    },
    formatTime (time) {
      if (time) return moment(time).format("h:mm a")
    }
  },
  methods: {
    ...mapActions({
      removeJobInterview: 'jobs/removeJobInterview',
      updateJobInterviewToCompleted: 'jobs/updateJobInterviewToCompleted'
    }),
    remove (interviewId) {
      if (!confirm("Are you sure?")) {
        return
      }
      this.removeJobInterview(interviewId)
        .then(response => {
          this.$toastr.s('Deleted successfully')
        })
        .catch(error => {
          this.$toastr.e('Delete failed')
        })
    },
    edit () {
      this.$emit('editInterview', this.interview)
    },
    done (interviewId) {
      this.updateJobInterviewToCompleted(interviewId)
        .then(response => {
          this.$toastr.s('Updated successfully')
        })
        .catch(error => {
          this.$toastr.e("Failed.")
        })
    }

  },
  mounted () {

  }
}
</script>
