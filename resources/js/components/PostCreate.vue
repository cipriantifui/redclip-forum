<template>
    <div>
        <div class="row" style="border-bottom: 2px solid #6c757d">
            <h3>Create Post</h3>
        </div>


        <div class="row">
            <div class="col-12 px-0 pt-2">
                <div class="card">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-post-tab"
                               data-toggle="pill" href="#pills-post" role="tab" aria-controls="pills-post"
                               aria-selected="true">Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-video-tab"
                               data-toggle="pill" href="#pills-video-link" role="tab" aria-controls="pills-video-link"
                               aria-selected="false">Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-image-tab"
                               data-toggle="pill" href="#pills-image-link" role="tab" aria-controls="pills-image-link"
                               aria-selected="false">Image</a>
                        </li>
                    </ul>

                    <div class="col-12">
                        <div class="form-group">
                            <select v-model="topic_selected" class="form-control">
                                <option v-bind:value="''">--- Select topic ---</option>
                                <option v-for="topic in topics" v-bind:value="topic.id">
                                    {{ topic.title }}
                                </option>
                            </select>
                            <span class="text text-danger"
                                  v-if="error && errors.topic_id">{{ errors.topic_id[0] }}</span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" v-model="title">
                            <span class="text text-danger"
                                  v-if="error && errors.title">{{ errors.title[0] }}</span>
                        </div>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-post" role="tabpanel"
                             aria-labelledby="pills-post-tab">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea rows="5" class="form-control" placeholder="Content" v-model="content"></textarea>
                                    <span class="text text-danger"
                                          v-if="error && errors.content">{{ errors.content[0] }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-video-link" role="tabpanel"
                             aria-labelledby="pills-video-link-tab">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea rows="3" class="form-control" placeholder="Video link" v-model="url_video"></textarea>
                                    <span class="text text-danger"
                                          v-if="error && errors.url_video">{{ errors.url_video[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-image-link" role="tabpanel"
                             aria-labelledby="pills-image-link-tab">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea rows="3" class="form-control" placeholder="Image link" v-model="url_image"></textarea>
                                    <span class="text text-danger"
                                          v-if="error && errors.url_image">{{ errors.url_image[0] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 text-right pb-2">
                        <button type="button" class="btn btn-secondary" @click="savePost()">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostCreate.vue",
        data() {
            return {
                error: false,
                errors: {},
                topics: {},
                topic_selected: '',
                title: '',
                content: null,
                url_video: null,
                url_image: null,
            }
        },
        beforeMount() {
            this.getPosts();
        },
        methods: {
            getPosts() {
                this.axios.get('/api/topic')
                    .then(response => {
                        this.topics = response.data;
                    }).catch(error => {
                    });
            },

            savePost() {
                console.log(this.content);
                this.error = false;
                let url = this.$store.state.isLoggedIn ? '/api/auth/post/create' : '/api/post/create';
                console.log(url);
                this.axios.post(url, {
                    topic_id: this.topic_selected,
                    title: this.title,
                    content: this.content,
                    url_video: this.url_video,
                    url_image: this.url_image,
                    uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                }).then(response => {
                    this.$toaster.success('The post was added successfully.');
                    this.topic_selected = ''
                    this.title = ''
                    this.content= null
                    this.url_video= null
                    this.url_image= null
                }).catch(error => {
                    if (error.response) {
                        if (error.response.data.errors.error) {
                            this.$toaster.error(error.response.data.errors.error)
                        } else {
                            this.error = true;
                            this.errors = error.response.data.errors
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .nav-pills .nav-link.active {
        color: #ffffff;
        background-color: #6c757d;
    }

    a {
        color: #6c757d;
    }
</style>
