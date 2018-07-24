<template>
    <div class="well">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width:100%" v-bind:src="cover_image_src" >
            </div>
            <div class="col-md-8 col-sm-8">
                <h3><a v-bind:href="post_id_href" >{{post.title}}</a></h3>
                <small>Written on {{post.created_at}} by {{post.user.name}}</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['post'],
        data() {
            return {
                post_id_href: '',
                cover_image_src: ''
            }
        },
        mounted() {
            this.post_id_href = 'post/'+this.post.id;
                this.cover_image_src = '/storage/cover_images/'+this.post.cover_image;
        }
    }
</script>

<style>
    .well{
        margin-bottom: 20px;
    }
</style>