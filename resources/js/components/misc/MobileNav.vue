<template>
  <div class="dropdown">

    <!-- TRIGGER -->
    <div class="" aria-haspopup="true"
      :aria-expanded="isOpen"
      @click.prevent="isOpen = !isOpen"
    >
      <icon name="mobilemenu" class="w-6 h-6 fill-current text-gray-700"
        v-if="!isOpen"
      />
      <icon name="cancel" class="w-6 h-6 fill-current text-gray-700"
        v-else
      />
    </div>

    <transition name="fade" appear>
    <!-- MENU LINKS -->
    <div class="dropdown-menu absolute mt-4 px-2 w-full sm:w-1/2 md:w-1/3 bg-white rounded-lg py-3 text-gray-600 z-50 left-0 sm:right-0 shadow-cc"
      v-show="isOpen"
    >
      <div class="ring-4 ring-indigo-500 ring-opacity-50 ring-offset-2 ring-offset-indigo-100">
        <slot></slot>
      </div>
    </div>
    </transition>

  </div>
</template>

<script>
  export default {
    data() {
      return {
        isOpen: false
      }
    },

  }
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: all .5s ease-out;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
