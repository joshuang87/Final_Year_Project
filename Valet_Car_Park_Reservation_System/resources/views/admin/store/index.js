import { createStore } from "vuex"
import { getInfo } from '$/api/manager.js'
import { login } from "../api/manager"
import { setToken,removeToken } from "../modules/auth"

const store = createStore({
    state() {
        return {
            // User Data
            user: {},
            // Side Bar State
            isCollapse: true,

        }
    },
    mutations: {
        // Record User Data
        setUserinfo(state,user) {
            state.user = user
        },
        // Change Side Bar State
        changeState(state) {
            return state.isCollapse == true ? state.isCollapse = false : state.isCollapse = true
        }
    },
    actions: {
        login({ commit }, { name,password }) {
            return new Promise((resolve,reject)=>{
                login(name,password).then((response)=>{
                    setToken(response.token)
                    resolve(response)
                })
                .catch((error)=>{
                    reject(error)
                })
            })
        },
        // Get Current Logged User Data
        getInfo({ commit }) {
            return new Promise((resolve,reject)=>{
                getInfo().then((response)=>{
                    commit('setUserinfo',response)
                    resolve(response)
                })
                .catch((error)=>{
                    reject(error)
                })
            })
        },
        // User Logout
        logout({ commit }) {
            // Remove Token In The Cookie
            removeToken()
            // Remove Current User State
            commit('setUserinfo',{})
        },
        collapse({ commit }) {
            commit('changeState')
        }
    }
})

export default store