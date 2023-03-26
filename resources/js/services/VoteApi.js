import axios from 'axios'
import store from '../stores/store';
export default {
    saveVote(postId) {
        let url = store.getters.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';
        return axios.post(url, {
            post_id: postId,
            uid: store.getters.notLoggedUserId,
        })
    }
}
