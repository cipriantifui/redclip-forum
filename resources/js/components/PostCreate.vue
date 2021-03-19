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
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <textarea rows="5" class="form-control" placeholder="Content"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-video-link" role="tabpanel"
                             aria-labelledby="pills-video-link-tab">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <textarea rows="3" class="form-control" placeholder="Video link"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-image-link" role="tabpanel"
                             aria-labelledby="pills-image-link-tab">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <textarea rows="3" class="form-control" placeholder="Image link"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 text-right pb-2">
                        <button type="button" class="btn btn-secondary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostCreate.vue"
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
