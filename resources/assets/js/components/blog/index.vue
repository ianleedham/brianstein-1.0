<template>
    <div>
        <h1 >Blog</h1>
        <p>
            This blog was the first thing I created using the Laravel framework.
            It demonstrates eloquent through the crud functionality: create, read, update, destroy.
            The boiler plate for the controllable and database migration was generated through the artisan command I just
            had to fill in the specifics.
            The blog also includes file uploading which is made extremely easy via Laravel and validation which checks what
            is being presented is correct.
            It also has access controls via Laravels inbuilt auth middle wear and if statements. This means that you can
            only edit or delete your own posts and are only able to add, edit or delete at all if you are logged in.
        </p>
        <div style="padding: 3rem">
            <h2>Posts</h2>
            <post v-show="post" v-for="post in posts" v-bind:post="post"  :key="post.id"> </post>
                <p v-show="posts.length = 0">No posts found</p>
        </div>
    </div>
</template>

<script>
    import Post from './partials/post'
    export default {
        components: {
            Post
        },
        data() {
            return {
                posts: [],
                meta: {},
            }
        },
        methods: {
            get_posts: function() {
                axios.get('/api/posts', {
                    params: {
                        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1NDE3NDE3MDdlNWFlZGE3MWUxMGU2NmYxNzk2MmY0MzIzYmZhNTEyMTI3Nzg1YmE0ZmM1Nzk2MWRmZGYwOWFmMmUwOWZmNGE1ODhkMzM4In0.eyJhdWQiOiIyIiwianRpIjoiYTU0MTc0MTcwN2U1YWVkYTcxZTEwZTY2ZjE3OTYyZjQzMjNiZmE1MTIxMjc3ODViYTRmYzU3OTYxZGZkZjA5YWYyZTA5ZmY0YTU4OGQzMzgiLCJpYXQiOjE1MjY4MzcxMDEsIm5iZiI6MTUyNjgzNzEwMSwiZXhwIjoxNTU4MzczMTAxLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.Q0MNJn9W6wB67Ty2CIevG7bXzZCzNO0XxGtl9JqaYd9luC39eCFD8pbzTkT_YgXoL5CjiV0LjV8NbMBOYMZ26LsWNzeku05nIv92zFkbHJBiv2OTWLVBIZ4e39jFp6gLat--SkdJaOBAPheiSFJEwSIaTA1VbsveM4LtsaUAs0UKsuOJEjnkx3yUiahg8W32JC19MT5P1osD7ckes8rnA_XDjgvKbBPb1FlhAR3yN3KNNQjiQV_pqjJrwyGW-RKvxG3_YvUJAyzPW9f7Y9sTDKxeQDIPZ8b8quWlWaSVO93wtd6evmhq_YMWsecojyqh1kxb1Uosq-oblyJL3lpgqE45RdbKlWZDW6ObvHcdC_tFMx2CTgnhf99rrKPcQIQ8QO9wG4j8O_uQh17OjPnNz7FVh-2HHPCTLp5m-tsHjKu6H2ewBSK6PNrHp7cxjF8VI28OkcJz-kzSc3zTA5L3SPElcSxC036xlVT6SsW-oEBZus2KLwBeZB1JzzpgyXPshGy3ZQZL0tXmr7t-boU5dvw4EIsP11V-WjyBoEbbMajzGSbJ8BaIu663XktFm_tGBk9objmV0AD0Yzigrleq3Cavph9_5FT4GvSXResMk3pI1m7Cbsq6feCC6EHXMwcLu9ZD0nXt0TJfk1vEPTfgbpoO8ED8uKWAsZUC9x5v6uY'
                    }
                }).then((response) => {
                    this.posts = response.data.data;
                    this.meta = response.data.meta;
                })

            }
        },
        mounted() {
            this.get_posts()
        },
    }
</script>