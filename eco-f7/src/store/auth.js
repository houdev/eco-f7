import axios from "axios";

export default {
  namespaced: true,
  state: {
    token: null,
    user: null
  },
  getters:{
    authenticated(state){
      return state.token && state.user
    },
    user(state){
      return state.user
    }
  },
  mutations: {
    SET_TOKEN(state, token){
      state.token = token
    },
    SET_USER(state, data){
      state.user = data
    }
  },
  actions:{
    signUp(_, signUpForm){
      return axios.post('auth/register', signUpForm);
    },
    signIn({ dispatch }, credentials){
       return axios.post('auth/login', credentials)
          .then(response => {
            dispatch('attempt', response.data.token)
          });
    },
    attempt({ commit, state }, token){
      if(token){
        commit('SET_TOKEN', token)
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}` ;
        localStorage.setItem('token', token);
      }

      if(!state.token){
        return
      }

      try{
        axios.post('auth/me').then(response => {
          commit('SET_USER', response.data)
        } )
      }catch (e) {
        console.log(e)
        commit('SET_TOKEN', null)
        commit('SET_USER', null)
      }
    },
    signOut({ commit }){
      return axios.post('auth/logout').then(() => {
        commit('SET_TOKEN', null)
        commit('SET_USER', null)
        localStorage.removeItem('token');
      })
    }
  },
}