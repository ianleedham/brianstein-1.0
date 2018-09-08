<template lang="html">
    <div class="dictionary">
        <div v-show="words.length===0" class="empty"><p>nothing here yet</p></div>
        <div class="text-center" style="padding-top: 10px">
            <a class="btn btn-dark " href="/dictionary/create">Add Word</a>
        </div>
        <!--   [{"wordid":1,"english":"Heart","jyutping":"sam","cantonese":"\u5fc3","soundAddress":"sam.3gp","type":"1","syncsts":0}-->
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th class="col-md-3" v-on:click.prevent="changeOrder('english')" ref="english_title">
                        <a href="#">English</a>
                    </th>
                    <th class="col-md-3" v-on:click.prevent="changeOrder('cantonese')" >
                        <a href="#">Cantonese</a>
                    </th>
                    <th class="col-md-3" v-on:click.prevent="changeOrder('jyutping')" >
                        <a href="#">Jyutping</a>
                    </th>
                </tr>
                </thead>
                <tbody>

                <Word v-for="word in words" v-bind:word = "word" :key="word.id" v-on:word:deleted="getwords"></Word>

                </tbody>
            </table>
            <pagination :meta="meta" v-on:pagination:switched="getwords"></pagination>
        </div>

    </div>
</template>


<script>
    import Word from './partials/dictionary-word.vue'
    import WordComposer from './partials/word-composer.vue'
    import Pagination from '../pagination/pagination.vue'

    export default {
        components: {
            Word,
            WordComposer,
            Pagination,
        },
        data() {
            return {
                sortby: 'english',
                order: 'asc',
                words: [],
                meta: {},
            }
        },
        computed: {
        },
        methods: {
            getwords (page = 1) {
                axios.get('/dictionary', {
                    params: {
                        page: page,
                        sortby: this.sortby,
                        order: this.order,
                    }
                }).then((response) => {
                    console.log(response);
                    this.words = response.data.data;
                    this.meta = response.data.meta;
                })
        },
            play: function (event) {
                this.$refs.audioElm.play();
            },
            changeOrder: function (button) {
                if (this.sortby===button){
                    if (this.order ==='asc'){
                        this.order='dec';
                    }else {
                        this.order='asc'
                    }
                }else {
                    this.sortby = button;
                    this.order = 'asc'
                }
                this.getwords(1)
            },
        },
        mounted () {
            this.getwords()
        },


    }


</script>

<style lang="css">
    .chat-log .dictionary-message:nth-child(even) {
        background-color: #ccc;
    }
    .empty {
        padding: 1rem;
        text-align: center;
    }

    .col-md-3{
        width: 25%;
    }
</style>
