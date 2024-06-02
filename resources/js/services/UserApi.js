import axios from 'axios'
export default {
    getUserDetails(userId) {
        return axios.get('/api/user/details/' + userId)
    },
    getUserPostsDetails(userId, section, perPage, page) {
        return axios.get('/api/user/posts-details/' + userId, {
            params: {
                section: section,
                perPage: perPage,
                page: page,
            }
        })
    },
    getLiveStatus(userId) {
        return axios.get('/api/user/live-status/' + userId)
    }
}
