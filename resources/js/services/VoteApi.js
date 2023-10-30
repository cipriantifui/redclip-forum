import axios from 'axios'
import store from '../stores/store';
export default {
    saveVote(postId) {
        let url = store.getters.isLoggedIn ? '/api/auth/vote/create' : '/api/vote/create';
        return axios.post(url, {
            votable_id: postId,
            votable_type: 'App\\Models\\Post',
            uid: store.getters.isLoggedIn ? null : store.getters.notLoggedUserId,
        })
    }
}
