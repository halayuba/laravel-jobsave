<template>
  <div class="mt-4 xl:mt-8 bg-white p-4">

    <!-- ALERT COMPONENTS -->
    <ErrorAlert
      v-if="errorsExist"
      :errors="errors"
    />

    <!-- FORM -->
    <div class="flex items-center p-2">
      <form class="w-full" action="" method="post"
        @submit.prevent="submit"
      >
        <div class="flex flex-col">
          <div class="flex flex-col sm:flex-row">
            <!-- COMPANY -->
            <input class="w-full lg:w-1/3 block pl-4 py-3 bg-gray-900 rounded-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Company"
              v-model="form.company"
            />
            <!-- LOCATION -->
            <input class="mt-2 sm:mt-0 sm:ml-2 w-full lg:w-1/3 block pl-4 py-3 bg-gray-900 rounded-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Location"
              v-model="form.location"
            />
            <!-- POSITION -->
            <input class="mt-2 sm:mt-0 sm:ml-2 w-full lg:w-1/3 block pl-4 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Position"
              v-model="form.position"
            />
          </div>
          <!-- URL -->
          <div class="mt-2"
            v-if="showFlag == 'link'"
          >
            <input class="w-full block pl-4 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="URL"
              v-model="form.url"
            />
          </div>
          <!-- NOTES -->
          <div class="mt-2"
            v-if="showFlag == 'note'"
          >
            <textarea class="w-full block pl-4 py-3 bg-gray-900 rounded-l-sm text-white placeholder-gray-400 focus:bg-gray-100 focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" rows="2" placeholder="Note"
              v-model="form.note"
            ></textarea>
          </div>
        </div>
        <div class="mt-4 flex justify-between">
          <div class="flex items-center">
            <!-- LINK -->
            <a href="#" class="rounded-sm bg-indigo-500 hover:bg-indigo-400 text-white px-2 py-1 ml-1" title="URL"
              @click.prevent="toggleShowFlag('link')"
            >
              <font-awesome-icon icon="link" />
            </a> <!-- LINK -->
            <!-- NOTES -->
            <a href="#" class="ml-3 rounded-sm bg-yellow-700 hover:bg-yellow-600 text-white px-2 py-1 ml-1" title="Note"
              @click.prevent="toggleShowFlag('note')"
            >
              <font-awesome-icon icon="sticky-note" />
            </a> <!-- NOTES -->
          </div>
          <!-- SAVE BUTTON -->
          <button class="mt-4 text-center align-middle whitespace-no-wrap select-none cursor-pointer inline-block mb-0 bg-blue-500 text-white font-semibold text-lg rounded-r-sm leading-tight px-4 py-2 shadow"
            :class="btnState"
          >Save</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  import ErrorAlert from '@/misc/ErrorAlert'

  export default {
    data() {
      return {
        errors: [],
        showFlag: '',
        form:{
          company: '',
          location: '',
          position: '',
          url: '',
          note: '',
        }
      }
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
          'pointer-events-none opacity-50': ! this.formSubmitIsReady,
        }
      },
      errorsExist() {
        return this.errors ? this.errors.length > 0 : null
      },
    },
    methods: {
      ...mapActions({
        storeJobSubmission: 'jobs/storeJobSubmission',
      }),
      submit() {
        if ( this.formSubmitIsReady ) {

          /* == CHECK IF THE SUBMISSION IS A DUPLICATE (HAD PREVIOUSLY BEEN STORED) == */
          const flagExist = this.submissions.some(item => item.company.toLowerCase() == this.form.company.toLowerCase() && item.position.toLowerCase() == this.form.position.toLowerCase())
          if(flagExist){
            if(!confirm("It appears that you've been submitted for the same position before. Do you want to store this again?")){
              return
            }
          }
          this.storeJobSubmission({
            payload: this.form
          })
            .then(response => {
              if(response.status === 409){
                this.$toastr.e(response.message)
              } else {
                this.$toastr.s('Created successfully')
                this.resetFields()
              }
            })
            .catch(error => {
              this.flashErrors(error.response.data.errors)
              this.$toastr.e(error.response.data.message)
            })
        } else {
          this.$toastr.w('Your entry is empty')
        }
      },
      flashErrors(errors) {
        for( const [key, value] of Object.entries(errors)) {
          for(let item in value) {
            if( value[item] ) this.errors.push(value[item])
          }
        }
      },
      resetFields(){
        this.form.company = ''
        this.form.location = ''
        this.form.position = ''
        this.form.url = ''
        this.form.note = ''
        this.showFlag = ''
      },
      toggleShowFlag(val = ''){
        this.showFlag = this.showFlag == val ? '' : val
      }
    },
  }
</script>
