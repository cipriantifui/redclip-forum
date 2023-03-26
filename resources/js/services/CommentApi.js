import axios from 'axios'
import store from "../stores/store";
export default {
    createCommentLike(commentId) {
        let url = store.getters.isLoggedIn ? '/api/auth/comment-like/create' : '/api/comment-like/create';
        return axios.post(url, {
            comment_id: commentId,
            uid: store.getters.isLoggedIn ? 0 : store.getters.notLoggedUserId,
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
