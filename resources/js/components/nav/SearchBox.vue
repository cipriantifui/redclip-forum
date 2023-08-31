<template>
    <div>
        <div class="input-box">
            <input type="text"
                class="form-control search-input"
                placeholder="Search..."
                v-model="searchText"
                @input="handleInput"
                @click-outside="isShowSuggest=false"
                @focus="handleFocus">
            <i class="fa fa-search" v-if="searchText.trim().length === 0"></i>
            <i class="fa fa-times-circle-o" aria-hidden="true" v-else @click="handleBlur"></i>
        </div>
        <div class="card" v-show="isShowSuggest">
            <div class="list-search-for">
                <i class="fa fa-search"></i>
                <div class="d-flex flex-column ml-2">
                    <span>Search all discussion for <strong>{{searchText}}</strong></span>
                </div>
            </div>
            <div class="list-search-for border-top" v-if="filteredDiscussions.length === 0 && filteredUsers.length === 0">
                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                <div class="d-flex flex-column ml-2">
                    <span>Nothing found</span>
                </div>
            </div>
            <div v-else>
                <div v-if="filteredDiscussions.length > 0" class="list-group border-top">
                    <span>Discussions</span>
                    <div class="item" v-for="(item, index) in filteredDiscussions"
                        :class="{'border-bottom': filteredDiscussions.length > index + 1}"
                        @click="choseDiscussion(item)">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        <div class="d-flex flex-column ml-2">
                            <span>{{item.title}}</span>
                            <small>{{item.text}}</small>
                        </div>
                    </div>
                </div>
                <div v-if="filteredUsers.length > 0" class="list-group border-top">
                    <span>Users</span>
                    <div class="item" v-for="(user, index) in filteredUsers"
                         :class="{'border-bottom': filteredUsers.length > index + 1}">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <div class="d-flex flex-column ml-2">
                            <span>{{user.name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {list} from "postcss";
import axios from "axios";

export default {
    name: "SearchBox",
    data() {
        return {
            isShowSuggest: false,
            searchText: '',
            filteredDiscussions: [],
            filteredUsers: [],
        }
    },
    methods: {
        handleInput(e) {
            this.isShowSuggest = true
            let searchText = e.target.value.toLowerCase();

            if(searchText.length > 3) {
                axios.get('/api/search/get-users-posts', {params: {searchText: searchText}})
                    .then(response => {
                        let responseData = response.data
                        if(responseData !== undefined && responseData.posts !== undefined) {
                            this.filteredDiscussions = responseData.posts
                        }
                        if(responseData !== undefined && responseData.users !== undefined) {
                            this.filteredUsers = responseData.users
                        }
                    })
            } else {
                this.isShowSuggest = false
            }
        },
        handleBlur() {
            this.$nextTick(() => {
                this.searchText = ''
                this.isShowSuggest = false
            })
        },
        handleFocus() {
            this.isShowSuggest = this.searchText.trim().length > 0
        },
        choseDiscussion(item) {
            let routerPostId = this.$route.params.post_id ?? null
            if(item.id != routerPostId) {
                this.$router.push({name: 'post-details', params: {post_id: item.id}})
            }
        }
    }
}
</script>

<style scoped>
.card{
    position: absolute;
    z-index: 100;
    background-color: #fff;
    padding: 15px;
    border:none;
    margin-top: 5px;
    box-shadow: 0px 1px 3px #888888;
    width: 350px;
}

.input-box{
    position: relative;
}

.search-input {
    position: relative;
    background-color: #eeeeee69;
    box-shadow: none;
    border-color: #eee;
    color: #eee;
}
.search-input::placeholder{
    color: #eee;
}

.input-box i {
    position: absolute;
    right: 11px;
    top:11px;
    color:#ced4da;
}

.search-input:focus {
    background-color: #fff;
    box-shadow: none;
    border-color: #ddd;
    width: 350px;
}
.search-input:focus::placeholder {
    color: #818181;
}
.list-search-for {
    padding-top: 10px;
    padding-bottom: 10px;
    display: flex;
    align-items: center;
    font-size: 12px;
}
.list-group {
    padding-top: 5px;
    padding-bottom: 5px;
    font-weight: bold;
    font-size: 14px
}

.list-group .item {
    padding-top: 10px;
    padding-bottom: 10px;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.border-bottom{
    border-bottom: 2px solid #eee;
}

.border-top{
    border-top: 2px solid #eee;
}

.list i{
    font-size: 19px;
    color: red;
}

.list small{
    color:#dedddd;
}
</style>
