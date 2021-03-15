<template>
    <!-- SEARCH -->
    <div class="relative w-full sm:w-64 flex items-center">
      <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
        <icon name="search" class="w-4 h-4 fill-current text-gray-300" />
      </span>

      <!-- CLEAR SEARCH -->
      <figure class="absolute right-0 pr-4 flex items-center text-red-500 cursor-pointer" title="clear search"
        @click="clearSearch"
        v-if="searchField"
      >
        <icon name="backspace" class="w-6 h-6" />
      </figure>

      <input type="text" class="w-full block pl-10 pr-4 py-3 bg-gray-900 rounded-lg text-sm text-white placeholder-gray-400 focus:bg-white focus:text-gray-900 focus:placeholder-gray-600 focus:outline-none" placeholder="Search" autofocus
        v-model="searchField"
        @input="processInput"
      >
    </div> <!-- SEARCH -->
</template>

<script>
  export default {
    data() {
      return {
        searchField: '',
      }
    },
    methods: {
      processInput(e){
        this.$emit('captured', e.target.value)
      },
      clearSearch() {
        this.searchField = ''
        this.$emit('clearSearch')
      },

    }
  }
</script>
