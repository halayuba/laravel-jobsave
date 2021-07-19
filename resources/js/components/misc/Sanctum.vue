<template>
  <div>
    {{ user }}
    <alert-container />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import AlertContainer from './AlertContainer'

export default {
  data () {
    return {
      user: null,
      username: '',
      bg: ''
    }
  },
  components: {
    AlertContainer
  },
  methods: {
    ...mapActions({
      snack: 'snack/snack'
    }),
    triggerSnack () {
      this.snack({
        text: this.username,
        bg: this.bg
      })
    },
    async fetchUser () {
      try {
        let response = await axios.get('/api/user')
        this.user = response.data
        this.username = `Authenticated! User ${response.data.name} is logged in`
        this.bg = 'bg-green-500'
        this.triggerSnack()
      } catch (error) {
        if (error.response.status === 401) {
          // this.user = 'Unauthorized! No user logged in'
          this.username = 'Unauthorized! No user logged in'
          this.bg = 'bg-red-500'
          this.triggerSnack()
          // this.$toastr.e('Unauthorized')
          // location = '/login'
        }
      }

    }
  },
  mounted () {
    this.fetchUser()
  }
}
</script>
