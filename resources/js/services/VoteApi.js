import axios from 'axios'
import store from '../store';
export default {
    saveVote(postId) {
        let url = store.state.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';
        return axios.post(url, {
            post_id: postId,
            uid: store.state.notLoggedUserId,
        })
    }
}
