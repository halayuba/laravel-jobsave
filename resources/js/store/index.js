import Vue from 'vue'
import Vuex from 'vuex'
import jobs from './jobs'
import snack from './snack'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    snack,
    jobs
  }
})
