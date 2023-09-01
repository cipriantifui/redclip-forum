import axios from 'axios'
export default {
    getUserPostsDetails(userId) {
        return axios.get('/api/users-post-details/' + userId)
    },
}
