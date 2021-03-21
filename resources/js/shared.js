export default {
    methods: {
        savePostVote(postId) {
            let url = this.$store.state.isLoggedIn ? '/api/auth/post-vote/create' : '/api/post-vote/create';

            this.axios.post(url, {
                post_id: postId,
                uid: this.$store.state.isLoggedIn ? null : this.$uoid,
            }).then(response => {
                var foundIndex = this.posts.findIndex(x => x.id === postId);
                var votes = this.posts[foundIndex].votes_count;
                this.posts[foundIndex].votes_count = response.data.voteUp ? (votes+1) : (votes-1);
            }).catch(error => {
                if (error.response) {
                    if (error.response.data.errors.error) {
                        this.$toaster.error(error.response.data.errors.error)
                    } else {
                        this.$toaster.error(error.response.data.errors.error)
                    }
                }
            });
        }
    }
}
