<template>
  <div>
    <alert-container />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import AlertContainer from './AlertContainer'

  export default {
    data() {
      return {
      }
    },
    components:{
      AlertContainer
    },
    props: ['state', 'message', 'redirect'],
    methods: {
      ...mapActions({
        snack: 'snack/snack'
      }),
      triggerSnack(){
        if(this.message.length > 0){
          this.snack({
            text: this.message,
            bg: this.state,
            redirect: this.redirect,
          })
        }
      }

    },
    created() {
      this.triggerSnack()
    }

  }
</script>
