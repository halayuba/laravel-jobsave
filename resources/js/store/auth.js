import axios from 'axios'
import baseUrl from '../baseUrl'

export default {
  namespaced: true,
  state: {
    auth: false,
    user: null,
  },
  getters: {
    auth (state) {
      return state.auth
    },
    user (state) {
      return state.user
    },
  },
  mutations: {
    SET_AUTH (state, value) {
      state.auth = value
    },
    SET_USER (state, value) {
      state.user = value
    },
  },
  actions: {
    async userAuth ({ commit }) {
      try {
        let response = await axios.get(baseUrl.authApiUrl)
        commit('SET_AUTH', true)
        commit('SET_USER', response.data.data)
        return Promise.resolve(response)
      } catch (error) {
        // console.log(error.response.status);
        commit('SET_AUTH', false)
        commit('SET_USER', null)
        return Promise.reject(error);
      }
    },
  }
}
