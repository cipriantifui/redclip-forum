<template>
    <div>
        <ValidationObserver ref="content_validation">
            <b-form-group>
                <ValidationProvider rules="required|min:5" name="title" mode="eager" v-slot="{ errors, failed }">
                    <b-form-input placeholder="Title" v-model="title" :class="`invalid is-${failed}`"></b-form-input>
                    <span class="text-danger text">{{ errors[0] }}</span>
                </ValidationProvider>
                <span class="text text-danger"
                      v-if="hasError && beErrors.title">{{ beErrors.title[0] }}</span>
            </b-form-group>

            <b-form-group>
                <ValidationProvider rules="required|min:5" name="content" mode="eager" v-slot="{ errors, failed }">
                    <b-form-textarea rows="3" :class="`invalid is-${failed}`" placeholder="Content" no-resize
                                     v-model="content" name="content"></b-form-textarea>
                    <span class="text-danger">{{ errors[0] }}</span>
                    <span class="text text-danger"
                          v-if="hasError && beErrors.content">{{ beErrors.content[0] }}</span>
                </ValidationProvider>
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
    name: "PostDiscussionForm",
    inject: ["eventHub"],
    data() {
        return {
            hasError: false,
            beErrors: {},
            title: '',
            content: null,
        }
    },
    mounted() {
    },
    methods: {
        savePost() {
            let hasValidationErrors = false;
            if(this.$store.getters.getSelectedDiscussionTag === null) {
                this.eventHub.$emit('tagSelectEvent', true)
                hasValidationErrors = true;
            }
            this.$refs.content_validation.validate().then(success => {
                if (!success || hasValidationErrors) {
                    return;
                }

                let data = {
                    topic_id: this.$store.getters.getSelectedDiscussionTag.id,
                    title: this.title,
                    content: this.content,
                    uid: this.$store.getters.isLoggedIn ? 0 : this.$store.getters.notLoggedUserId,
                };
                this.postData(data);
            });
        },
        postData(data, type) {
            this.hasError = false;
            PostApi.createPost(data, type)
                .then(response => {
                    this.$toaster.success('The post was added successfully.');
                    this.title = ''
                    this.content= null

                    // Wait until the models are updated in the UI
                    this.$nextTick(() => {
                        this.$refs.content_validation.reset();
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
