<template>
  <div class="flex flex-col sm:flex-row w-full sm:w-5/6 px-4 sm:px-0">
    <!-- DATE CREATED -->
    <div class="mt-2 w-full sm:w-1/6 text-sm font-light text-gray-700 xl:pl-1">
      {{ submission.created_at | formatDate }}
    </div>

    <!-- COMPANY / LOCATION -->
    <div class="mt-2 sm:pl-4 w-full sm:w-2/6">
      <div class="text-sm text-gray-900 flex items-center">

        <!-- STATUS INDICATORS -->
        <span
          :class="statusIndicator"
          :title="title"
        ></span>
        <span class="ml-1">{{ submission.company }}</span>
      </div>
      <div class="text-sm text-gray-500">{{ submission.location }}</div>
    </div>

    <!-- POSITION -->
    <div class="mt-2 sm:pl-4 w-full sm:w-3/6 text-sm text-gray-700">
      <div class="flex flex-col">
        <div class="flex">
          <span>{{ submission.position }}</span>

          <!-- LINK -->
          <a
            target="_blank"
            :href="submission.url"
            v-if="submission.url"
          >
            <icon
              name="link"
              class="w-4 h-4 fill-current text-indigo-400 hover:text-indigo-500 inline-block ml-1"
            />
          </a>
        </div>

        <!-- NOTES -->
        <div
          class="flex items-center"
          v-if="submission.note"
        >
          <picture
            class="cursor-pointer"
            @click="toggleShowNoteFlag(submission.id)"
          >
            <!-- NOTES -->
            <icon
              name="note2"
              class="w-5 h-5 fill-current text-indigo-400 hover:text-indigo-500"
            />
          </picture>

          <span
            class="ml-1 text-xs font-light"
            v-if="showNoteFlag == submission.id"
          >{{ submission.note }}</span>
        </div>

        <!-- INTERVIEW -->
        <div
          class="mt-1 flex flex-col"
          v-if="upcomingInterviewFullRecord"
        >
          <div class="flex items-center">
            <!-- SHOW MORE DETAILS -->
            <picture
              v-if="!showInterviewFlag"
              @click="toggleShowInterviewFlag(submission.id)"
            >
              <icon
                name="arrow-down"
                class="w-6 h-6 fill-current text-indigo-400 cursor-pointer"
              />
            </picture>
            <picture
              class="ml-1 cursor-pointer"
              @click="toggleShowInterviewFlag(submission.id)"
            >
              <icon
                name="calendar"
                class="w-5 h-5 fill-current text-indigo-400 hover:text-indigo-500"
              />
            </picture>
            <span class="ml-1">{{ upcomingInterviewFullRecord.dateTime }}</span>
          </div>

          <!-- INTERVIEW DETAILS -->
          <div
            class="flex flex-col mt-2 bg-gray-200 p-2"
            v-if="showInterviewFlag == submission.id"
          >

            <!-- INTERVIEWER -->
            <div class="flex items-baseline">
              <icon
                name="users"
                class="w-4 h-4 fill-current text-gray-600"
              />
              <span class="text-gray-700 text-sm tracking-tight ml-2">{{ upcomingInterviewFullRecord.interviewer }}</span>
            </div>

            <!-- NOTES -->
            <div
              class="mt-1 flex items-center"
              v-if="submission.interviews[0].notes"
            >
              <icon
                name="note"
                class="w-6 h-6 fill-current text-gray-600"
              />
              <span class="text-gray-700 text-sm tracking-tight leading-none ml-1 flex-wrap">{{ upcomingInterviewFullRecord.notes }}</span>
            </div>

          </div> <!-- INTERVIEW DETAILS -->

        </div>

      </div>
    </div>

  </div>
</template>

<script>
import moment from 'moment'

export default {
  data () {
    return {
      showNoteFlag: '',
      showInterviewFlag: '',
      upcomingInterviewFlag: false,
      completedInterviewFlag: false,
      upcomingInterviewFullRecord: '',
      title: 'Unsuccessful submission'
    }
  },
  props: {
    submission: { required: true }
  },
  filters: {
    formatDate (date) {
      if (date) return moment(date).format("MM-DD-YYYY")
    },
  },
  computed: {
    statusIndicator () {
      return {
        'p-2 rounded-full bg-red-600': this.submission.status === 'Unsuccessful',
        'p-2 rounded-full bg-green-600': this.upcomingInterviewFlag,
        'p-2 rounded-full bg-green-300': this.completedInterviewFlag
      }
    },
    submissionWithInterview () {
      if (this.submission.interviews) {
        this.submission.interviews.map(interview => {
          if (interview.status === 'Upcoming') {
            this.upcomingInterviewFullRecord = interview
            this.upcomingInterviewFlag = true
            this.title = "Upcoming Interview"
          } else if (interview.status === 'Completed') {
            this.completedInterviewFlag = true
            this.title = "Interview Completed"
          }
        })
      }
    }

  },
  methods: {
    toggleShowNoteFlag (val) {
      this.showNoteFlag = this.showNoteFlag === val ? '' : val
    },
    toggleShowInterviewFlag (val) {
      this.showInterviewFlag = this.showInterviewFlag === val ? '' : val
    },

  },
  mounted () {
    this.submissionWithInterview
  }
}
</script>
