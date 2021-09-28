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

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-post" role="tabpanel"
                             aria-labelledby="pills-post-tab">
                            <div class="col-12">
                                <ValidationObserver ref="content_validation">
                                    <b-form-group>
                                        <ValidationProvider rules="required" v-slot="{ errors, failed }">
                                            <b-form-select v-model="topic_selected" :options="topics" value-field="id" text-field="title" :class="`invalid is-${failed}`">
                                                <template #first>
                                                    <b-form-select-option :value="null">-- Please select an topic --</b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>

                                        <span class="text text-danger"
                                              v-if="error && errors.topic_id">{{ errors.topic_id[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|min:5" v-slot="{ errors, failed }">
                                            <b-form-input id="input-1" placeholder="Title" v-model="title" :class="`invalid is-${failed}`"></b-form-input>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                        <span class="text text-danger"
                                              v-if="error && errors.title">{{ errors.title[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|min:5" v-slot="{ errors, failed }">
                                            <b-form-textarea rows="5" :class="`invalid is-${failed}`" placeholder="Content"
                                                             v-model="content" name="content"></b-form-textarea>
                                            <span class="text-danger">{{ errors[0] }}</span>
                                            <span class="text text-danger"
                                                  v-if="error && errors.content">{{ errors.content[0] }}</span>
                                        </ValidationProvider>
                                    </b-form-group>
                                </ValidationObserver>
                            </div>
                            <div class="col-12 text-right pb-2">
                                <button type="button" class="btn btn-secondary" @click="saveContentPost()">Post</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-video-link" role="tabpanel"
                                 aria-labelledby="pills-video-link-tab">
                            <div class="col-12">
                                <ValidationObserver ref="video_validation">
                                    <b-form-group>
                                        <ValidationProvider rules="required" v-slot="{ errors, failed }">
                                            <b-form-select v-model="topic_selected" :options="topics" value-field="id" text-field="title" :class="`invalid is-${failed}`">
                                                <template #first>
                                                    <b-form-select-option :value="null">-- Please select an topic --</b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>

                                        <span class="text text-danger"
                                              v-if="error && errors.topic_id">{{ errors.topic_id[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|min:5" v-slot="{ errors, failed }">
                                            <b-form-input id="input-1" placeholder="Title" v-model="title" :class="`invalid is-${failed}`"></b-form-input>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                        <span class="text text-danger"
                                              v-if="error && errors.title">{{ errors.title[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|mimes:video/*" v-slot="{ errors, failed }">
                                            <b-form-file v-model="url_video"
                                                placeholder="Choose a file or drop it here..."
                                                drop-placeholder="Drop file here..."
                                                :class="`invalid is-${failed}`"
                                                 ref="video_file"
                                            >
                                            </b-form-file>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                        <span class="text text-danger"
                                              v-if="error && errors.file_video">{{ errors.file_video[0] }}</span>
                                    </b-form-group>
                                </ValidationObserver>
                            </div>

                            <div class="col-12 text-right pb-2">
                                <button type="button" class="btn btn-secondary" @click="saveVideoPost()">Post</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-image-link" role="tabpanel"
                                 aria-labelledby="pills-image-link-tab">
                            <div class="col-12">
                                <ValidationObserver ref="image_validation">
                                    <b-form-group>
                                        <ValidationProvider rules="required" v-slot="{ errors, failed }">
                                            <b-form-select v-model="topic_selected" :options="topics" value-field="id" text-field="title" :class="`invalid is-${failed}`">
                                                <template #first>
                                                    <b-form-select-option :value="null">-- Please select an topic --</b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>

                                        <span class="text text-danger"
                                              v-if="error && errors.topic_id">{{ errors.topic_id[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|min:5|:test" v-slot="{ errors, failed }">
                                            <b-form-input id="input-1" placeholder="Title" v-model="title" :class="`invalid is-${failed}`"></b-form-input>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                        <span class="text text-danger"
                                              v-if="error && errors.title">{{ errors.title[0] }}</span>
                                    </b-form-group>

                                    <b-form-group>
                                        <ValidationProvider rules="required|mimes:image/*" v-slot="{ errors, failed }">
                                            <b-form-file v-model="url_image"
                                                         placeholder="Choose a file or drop it here..."
                                                         drop-placeholder="Drop file here..."
                                                         :class="`invalid is-${failed}`"
                                                         ref="video_file"
                                            >
                                            </b-form-file>
                                            <span class="text-danger text">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                        <span class="text text-danger"
                                              v-if="error && errors.file_image">{{ errors.file_image[0] }}</span>
                                    </b-form-group>
                                </ValidationObserver>
                            </div>
                            <div class="col-12 text-right pb-2">
                                <button type="button" class="btn btn-secondary" @click="saveImagePost()">Post</button>
                            </div>
                        </div>
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
                topic_selected: null,
                title: '',
                content: null,
                url_video: null,
                url_image: null,
            }
        },
        beforeMount() {
            this.getTopics();
        },
        methods: {
            getTopics() {
                this.axios.get('/api/topic')
                    .then(response => {
                        if(response.data && response.data.length >0 ) {
                            this.topics = response.data;
                        }

                    }).catch(error => {
                    });
            },
            saveVideoPost() {
                this.$refs.video_validation.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    let formData = new FormData();
                    formData.append('file_video', this.url_video);
                    formData.append('topic_id', this.topic_selected);
                    formData.append('title', this.title);
                    formData.append('uid',this.$store.state.isLoggedIn ? null : this.$uoid);

                    this.error = false;
                    let url = this.$store.state.isLoggedIn ? '/api/auth/post/create-video-post' : '/api/post/create-video-post';

                    this.postData(url,formData);
                });
            },
            saveImagePost() {
                this.$refs.image_validation.validate().then(success => {
                    if (!success) {
                        return;
                    }

                    let formData = new FormData();
                    formData.append('file_image', this.url_image);
                    formData.append('topic_id', this.topic_selected);
                    formData.append('title', this.title);
                    formData.append('uid',this.$store.state.isLoggedIn ? null : this.$uoid);

                    this.error = false;
                    let url = this.$store.state.isLoggedIn ? '/api/auth/post/create-image-post' : '/api/post/create-image-post';

                    this.postData(url,formData);
                });
            },
            saveContentPost() {
                this.$refs.content_validation.validate().then(success => {
                    if (!success) {
                       return;
                    }

                    this.error = false;
                    let url = this.$store.state.isLoggedIn ? '/api/auth/post/create-content-post' : '/api/post/create-content-post';
                    let data = {
                        topic_id: this.topic_selected,
                        title: this.title,
                        content: this.content,
                        uid: this.$store.state.isLoggedIn ? null : this.$uoid,
                    };

                    this.postData(url,data);
                });

            },

            postData(url,data) {
                this.axios.post(url, data).then(response => {
                    this.$toaster.success('The post was added successfully.');
                    this.topic_selected = null
                    this.title = ''
                    this.content= null
                    this.url_video= null
                    this.url_image= null

                    // Wait until the models are updated in the UI
                    this.$nextTick(() => {
                        this.$refs.content_validation.reset();
                    });
                    this.$nextTick(() => {
                        this.$refs.video_validation.reset();
                    });
                    this.$nextTick(() => {
                        this.$refs.image_validation.reset();
                    });
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
