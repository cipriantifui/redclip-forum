<template>
    <div class="detail-card" @click="handleChoosePost">
        <div class="row mb-2">
            <div class="col-auto pr-0 text-center">
                <avatar ref="avatar" :fullname="userName" :size="50" style="position:relative; top:4px"></avatar>
                <p style="font-size: 11px;font-weight: 700;min-width: 80px">{{detail.date_ago}}</p>
            </div>
            <div class="col-9">
                <h5 class='detail-card-title'>{{detailTitle}}</h5>
                <p class='detail-card-content' v-if="detail.type === 1">{{detailContent}}</p>
                <p class="content pt-2" v-if="detail.type === 2">
                    <img :src="detail.url_image" :alt="detail.title">
                </p>
                <p class="content pt-2" v-if="detail.type === 3">
                    <iframe
                        :src="detail.url_video"
                        width="100%"
                        height="100%"
                        autoplay="false"
                        frameborder="0">
                    </iframe>
                </p>
                <p><i class="fa fa-thumbs-up mr-2"></i> You like this.</p>
            </div>
        </div>
    </div>
</template>

<script>

import Avatar from "vue-avatar-component";
export default {
    name: "UserLikeDetailCard",
    components: {Avatar},
    props: {
        user: { require: true, type: Object },
        detail: { require: true},
        section: { require: true, type: String},
    },
    methods: {
        handleChoosePost() {
            let postId = this.detail.post_id ?? this.detail.id;
            this.$router.push({name: 'post-details', params: {post_id: postId}})
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
        userName() {
            return this.detail.user ? this.detail.user.name : ''
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
