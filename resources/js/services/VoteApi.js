import axios from 'axios'
import store from '../store';
export default {
    saveVote(postId) {
        let url = store.state.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';
        let uid = store.state.isLoggedIn ? null : this.$uoid;

        return axios.post(url, {
            post_id: postId,
            uid: uid,
        })
    }
}
