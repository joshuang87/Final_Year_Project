import axios from "axios"
import { getToken } from "$/modules/auth"
import { notification } from "$/modules/util"

const service =  axios.create()

// Add a request interceptor
service.interceptors.request.use(function (config) {
    // Do something before request is sent

    const token = getToken()

    if(token) {
        config.headers['token'] = token
    }

    return config
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });

// Add a response interceptor
service.interceptors.response.use(function (response) {
    return response.data
  },
  function (error) {
    // Display Error Notification
    notification('Error',error.response.data,'error')

    return Promise.reject(error)
  });

  export default service