import axios from 'axios'
import store from "../stores/store";
export default {
    createCommentLike(commentId) {
        let url = store.getters.isLoggedIn ? '/api/auth/vote/create' : '/api/vote/create';
        return axios.post(url, {
            votable_id: commentId,
            votable_type: 'App\\Models\\PostComment',
            uid: store.getters.isLoggedIn ? null : store.getters.notLoggedUserId,
        });
    },
    createComment(postId, commentId, content) {
        let url = store.getters.isLoggedIn ? '/api/auth/post-comment/create' : '/api/post-comment/create';
        return axios.post(url, {
            post_id: postId,
            parent_id: commentId,
            content: content,
            uid: store.getters.isLoggedIn ? null : store.getters.notLoggedUserId,
        })
    }
}
