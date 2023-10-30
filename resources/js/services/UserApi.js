import axios from 'axios'
export default {
    getUserDetails(userId) {
        return axios.get('/api/user/details/' + userId)
    },
    getUserPostsDetails(userId, section) {
        return axios.get('/api/user/posts-details/' + userId, {params: {section: section}})
    },
    getLiveStatus(userId) {
        return axios.get('/api/user/live-status/' + userId)
    }
}
