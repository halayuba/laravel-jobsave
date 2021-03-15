<template>
  <div class="fixed w-full left-0 top-0 flex justify-center">
    <transition name="snack">
      <div class="mt-12 text-white rounded-lg px-8 py-4"
        v-if="snack"
        :class="bg"
      >
        {{ snack }}
      </div>
    </transition>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  computed: {
    ...mapGetters({
      snack: 'snack/snack',
      bg: 'snack/bg'
    })
  },

}

</script>

<style>
  .snack-enter-active,
  .snack-leave-active {
    transition: all .5s ease-in-out;
  }

  .snack-enter,
  .snack-leave-to {
    transform: translateY(-48px);
    opacity: 0;
  }
</style>
