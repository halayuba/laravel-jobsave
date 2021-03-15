let defaults = {
  text: '',
  state: '',
  time: 2000,
  delay: 50,
  redirect: '/resources'
}

export default {
  namespaced: true,

  state: {
    snack: null,
    bg: null
  },
  getters: {
    snack(state) {
      return state.snack
    },
    bg(state) {
      return state.bg
    },
    redirect(state) {
      return state.redirect
    }
  },
  mutations: {
    SET_SNACK_TEXT(state, text) {
      state.snack = text
    },
    SET_SNACK_BG(state, bg) {
      state.bg = bg
    },
    SET_SNACK_REDIRECT(state, redirect) {
      state.redirect = redirect
    }
  },
  actions: {
    snack( {commit}, options ) {
      options = { ...defaults, ...options }

      setTimeout(() => {
        commit('SET_SNACK_TEXT', options.text)
        commit('SET_SNACK_BG', options.bg)
        commit('SET_SNACK_REDIRECT', options.redirect)

        setTimeout(() => {
          commit('SET_SNACK_TEXT', null)
          commit('SET_SNACK_BG', null)
          commit('SET_SNACK_REDIRECT', null)

          location = options.redirect
        }, options.time)

      }, options.delay)

    },

  }
}
