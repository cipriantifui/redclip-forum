import axios from 'axios'
export default {
    getUserPostsDetails(userId) {
        return axios.get('/api/user/post-details/' + userId)
    },
    getLiveStatus(userId) {
        return axios.get('/api/user/live-status/' + userId)
    }
}
