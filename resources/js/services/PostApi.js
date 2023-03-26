import axios from 'axios'
import store from "../stores/store";
export default {
    getPost(postId) {
        return axios.get('/api/post/' + postId)
    },
    getPosts(page, perPage) {
        return axios.get('/api/post', {params: {page: page, perPage: perPage}})
    },
    createPost(data, type) {
        type = type || ''
        let url = store.getters.isLoggedIn ? '/api/auth/post/create-content-post' : '/api/post/create-content-post';
        if(type === 'video') {
            url = store.getters.isLoggedIn ? '/api/auth/post/create-video-post' : '/api/post/create-video-post';
        } else if(type === 'image') {
            url = store.getters.isLoggedIn ? '/api/auth/post/create-image-post' : '/api/post/create-image-post';
        }

        return axios.post(url, data)
    },
}
