<template>
     <div>
         <router-link :to="{ name: 'post-create' }" class="btn btn-secondary mr-2"
            :class="{'d-xl-flex d-lg-flex': !isShowInTop}">Start a discussion</router-link>
         <router-link :to="{ name: 'home' }" class="btn btn-link text-secondary px-0 mr-2"
            :class="{'d-xl-flex d-lg-flex': !isShowInTop, 'mt-lg-2 mt-xl-2': !isShowInTop}">
             <i class="fa fa-comments-o mr-2" aria-hidden="true"></i> All discussions
         </router-link>
         <router-link :to="{ name: 'topics' }" class="btn btn-link text-secondary px-0 mr-2"
            :class="{'d-xl-flex d-lg-flex': !isShowInTop}">
             <i class="fa fa-list-ul mr-2" aria-hidden="true"></i> Topics
         </router-link>
     </div>
</template>

<script>
export default {
    name: "LeftSideNav",
    props: {
        isShowInTop: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.btn-link {
    font-weight: bold;
    align-items: center;
}
.btn-link:hover {
    text-decoration: none
}
.btn-link:focus {
    text-decoration: none
}
</style>
