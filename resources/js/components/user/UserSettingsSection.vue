<template>
    <div clas="row">
        <div class="col-12">
            <h3>Account</h3>
            <h5 class="mt-4">Change Email</h5>
            <div class="col-4 mb-3 px-0">
                <label for="emailInput" class="form-label">Email address</label>
                <input type="email"
                       v-model="email"
                       class="form-control"
                       id="emailInput"
                       placeholder="name@example.com">
            </div>
            <div class="col-4 mb-3 px-0">
                <label for="confirmEmailInput" class="form-label">Confirm email address</label>
                <input type="email"
                       v-model="confirmEmail"
                       class="form-control"
                       id="confirmEmailInput"
                       placeholder="Confirm email">
            </div>
            <div class="col-4 mb-4 px-0">
                <button type="button" class="btn btn-secondary" @click="handleSaveEmail">Save Changes</button>
            </div>
            <h5>Change Password</h5>
            <div class="col-4 mb-4 px-0">
                <button type="button" class="btn btn-secondary" @click="handleResetPassword">Send Password Reset Email</button>
            </div>
            <h5>Notification</h5>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "UserSettingsSection",
    props: {
        user: { require: true, type: Object },
    },
    data() {
        return {
            email: this.user.email ?? null,
            confirmEmail: null,
        }
    },
    methods: {
        handleSaveEmail() {
            axios.post('/api/auth/email/change', {
                userId: this.user.id,
                email: this.email,
                confirmEmail: this.confirmEmail,
            }).then(response => {
                this.$toaster.success('The email has been successfully changed.')
            }).catch(error => {
                if (error.response.status === 422) {
                    console.log(error.response.data.errors)
                    let errorMessage = error.response.data.errors.email ? error.response.data.errors.email[0] : null;
                    if(errorMessage === null) {
                        errorMessage = error.response.data.errors.confirmEmail ? error.response.data.errors.confirmEmail[0] : null;
                    }
                    this.$toaster.error(errorMessage)
                }
            });
        },
        handleResetPassword() {
            axios.post('/api/auth/forget-password', {
                email: this.email,
            }).then(response => {
                this.$toaster.success('The password reset link has been successfully sent to your email.')
            }).catch(error => {
                if (error.response.status === 422) {
                    let message = error.response.data.email || error.response.data.errors.email[0]
                    this.$toaster.error(message)
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
