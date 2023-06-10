<template>
    <div>
        <ValidationObserver ref="video_validation">
            <b-form-group>
                <ValidationProvider rules="required|min:5" name="title" mode="eager" v-slot="{ errors, failed }">
                    <b-form-input placeholder="Title" v-model="title" :class="`invalid is-${failed}`"></b-form-input>
                    <span class="text-danger text">{{ errors[0] }}</span>
                </ValidationProvider>
                <span class="text text-danger"
                      v-if="hasError && beErrors.title">{{ beErrors.title[0] }}</span>
            </b-form-group>

            <b-form-group>
                <ValidationProvider rules="required|mimes:video/*" name="video" mode="passive" v-slot="{ errors, failed }">
                    <b-form-file v-model="urlVideo"
                                 placeholder="Choose a file or drop it here..."
                                 drop-placeholder="Drop file here..."
                                 :class="`invalid is-${failed}`"
                                 ref="video_file">
                    </b-form-file>
                    <span class="text-danger text">{{ errors[0] }}</span>
                </ValidationProvider>
                <span class="text text-danger"
                      v-if="hasError && beErrors.file_video">{{ beErrors.file_video[0] }}</span>
            </b-form-group>
        </ValidationObserver>

        <div class="footer-actions">
            <button type="button" class="btn btn-secondary" @click="savePost()">Post Discussion</button>
        </div>
    </div>
</template>

<script>
import PostApi from "../../services/PostApi";

export default {
    name: "VideoDiscussionForm",
    inject: ["eventHub"],
    data() {
        return {
            hasError: false,
            beErrors: {},
            title: '',
            urlVideo: null,
        }
    },
    methods: {
        savePost() {
            let hasValidationErrors = false;
            if(this.$store.getters.getSelectedDiscussionTag === null) {
                this.eventHub.$emit('tagSelectEvent', true)
                hasValidationErrors = true;
            }

            this.$refs.video_validation.validate().then(success => {
                if (!success || hasValidationErrors) {
                    return;
                }

                let formData = new FormData();
                formData.append('file_video', this.urlVideo);
                formData.append('topic_id', this.$store.getters.getSelectedDiscussionTag.id);
                formData.append('title', this.title);
                formData.append('uid',this.$store.getters.isLoggedIn ? 0 : this.$store.getters.notLoggedUserId);
                this.postData(formData, 'video');
            });
        },
        postData(data, type) {
            this.hasError = false;
            PostApi.createPost(data, type)
                .then(response => {
                    this.$toaster.success('The post was added successfully.');
                    this.title = ''
                    this.urlVideo= null

                    // Wait until the models are updated in the UI
                    this.$nextTick(() => {
                        this.$refs.video_validation.reset();
                    });
                    this.eventHub.$emit('addedPostEvent')
                }).catch(error => {
                if (error.response) {
                    if (error.response.data.errors.error) {
                        this.$toaster.error(error.response.data.errors.error)
                    } else {
                        this.hasError = true;
                        this.beErrors = error.response.data.errors
                    }
                }
            });
        }
    }
}
</script>

<style scoped>
.footer-actions {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 3rem;
}
</style>
