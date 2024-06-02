<template>
    <div class="detail-card" @click="handleChoosePost">
        <div class="row mb-2">
            <div class="col-auto pr-0 text-center">
                <avatar ref="avatar" :fullname="user.name" :size="50" style="position:relative; top:4px"></avatar>
                <p style="font-size: 11px;font-weight: 700;min-width: 80px">{{detail.date_ago}}</p>
            </div>
            <div class="col-9">
                <h5 class='detail-card-title'>{{detailTitle}}</h5>
                <p class='detail-card-content' :class="section==='comments' ? 'pt-3' : ''">{{detailContent}}</p>
            </div>
            <div class="col-auto">
                <p><i class="fa fa-comments mr-2"></i> {{ comments }}</p>
                <p><i class="fa fa-thumbs-up mr-2"></i> {{ votes }}</p>
            </div>
        </div>
    </div>
</template>

<script>

import Avatar from "vue-avatar-component";
export default {
    name: "UserPostDetailCard",
    components: {Avatar},
    props: {
        user: { require: true, type: Object },
        detail: { require: true},
        section: { require: true, type: String},
    },
    methods: {
        handleChoosePost() {
            this.$router.push({name: 'post-details', params: {post_id: this.detail.id}})
        }
    },
    computed: {
        detailTitle() {
            let content = this.detail.title ?? '';
            if(content.length > 50) {
                content = content.substring(0,50) + ' ...';
            }
            return content;
        },
        detailContent() {
            let content = this.detail.content;
            if(content.length > 150) {
                content = content.substring(0,150) + ' ...';
            }
            return content;
        },
        votes() {
            return this.detail.votes_count
        },
        comments() {
            return this.detail.comments_count
        }
    }
}
</script>

<style>
.detail-card {
    cursor: pointer
}
.detail-card:hover {
    background: #EDF5F6F4;
}
</style>
