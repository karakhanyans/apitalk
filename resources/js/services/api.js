import axios from 'axios'

export default ()=>{
    return axios.create({
        baseURL: 'http://apitalk.loc/api/'
    })
}
