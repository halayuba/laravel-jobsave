<template>
  <div class="dropdown relative"
    v-on-clickaway="away"
  >

    <!-- TRIGGER -->
    <div class="" aria-haspopup="true"
      :aria-expanded="isOpen"
      @click.prevent="triggerDropdown"
    >
      <slot name="trigger"></slot>
    </div>

    <transition name="fade" appear>
    <!-- MENU LINKS -->
    <div class="dropdown-menu absolute mt-2 bg-white rounded-md shadow-cc px-2 py-4 text-gray-600 z-50"
      v-show="isOpen"
      :class="align === 'left' ? 'left-0' : 'right-0'"
      :style="{ width }"
    >
        <slot></slot>
    </div>
    </transition>

  </div>
</template>

<script>
  import { mixin as clickaway } from 'vue-clickaway'

  export default {
    mixins: [ clickaway ],
    data() {
      return {
        isOpen: false
      }
    },
    props: {
      align: { default: 'left' },
      width: { default: 'auto' }
    },
    methods:{
      triggerDropdown(){
        this.isOpen = !this.isOpen
      },
      away() {
        this.isOpen = false
      },
    },
    created: function() {
      document.addEventListener('keyup', (e) => {
        if (e.keyCode === 27) {
          this.away()
        }
      });
    },
    destroyed: function () {
      document.removeEventListener('keyup', this.escapeKeyListener);
    }

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
