import { createStore } from 'vuex';

export default createStore({
  state: {
    data: [], // Initialize an empty array to hold the data
  },
  mutations:{
    setData(state, data){
        state.data = data;
    },
    setNull(state, data){
      state.data = null;
    }
  },
  actions:{
    setData({commit}, data){
        commit('setData', data);
    },
    resetData({commit},data){
      commit("setNull",data);
    },
  },
});