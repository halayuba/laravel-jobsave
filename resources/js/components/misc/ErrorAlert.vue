<template>
  <div class="fixed w-full left-0 top-0 flex justify-center">
    <transition name="snack">
      <div class="mt-12 bg-red-500 text-white rounded-lg px-8 py-4" role="alert"
        v-if="errorsExist"
      >
        <ul>
          <li
            v-for="error in errors"
          >
            {{ error }}
          </li>
        </ul>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorsExist: this.errors.length > 0
    }
  },
  props: {
    errors: {
      required: true,
      default: null
    }
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
