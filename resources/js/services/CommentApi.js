import axios from 'axios'
import store from "../store";
export default {
    createCommentLike(commentId) {
        let url = store.state.isLoggedIn ? '/api/auth/comment-like/create' : '/api/comment-like/create';
        return axios.post(url, {
            comment_id: commentId,
            uid: store.state.isLoggedIn ? 0 : store.state.notLoggedUserId,
        });
    },
    createComment(postId, commentId, content) {
        let url = store.state.isLoggedIn ? '/api/auth/post-comment/create' : '/api/post-comment/create';
        return axios.post(url, {
            post_id: postId,
            parent_id: commentId,
            content: content,
            uid: store.state.isLoggedIn ? null : store.state.notLoggedUserId,
        })
    }
}
