<template lang="html">
    <div class="dictionary">
        <div v-show="orderedWords.length===0" class="empty"><p>nothing here yet</p></div>

        <!--   [{"wordid":1,"english":"Heart","jyutping":"sam","cantonese":"\u5fc3","soundAddress":"sam.3gp","type":"1","syncsts":0}-->
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th v-on:click="changeOrder('english')" ref="english_title">
                        <a href="#">English</a>
                    </th>
                    <th v-on:click="changeOrder('cantonese')" >
                        <a>Cantonese</a>
                    </th>
                    <th v-on:click="changeOrder('jyutping')" >
                        Jyutping
                    </th>
                    <th>
                        <div class="col-md-1 col-sm-1 text-center" style="padding-top: 10px">
                            <a class="btn btn-dark " href="/dictionary/create">Add Word</a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>

                <Word v-for="word in orderedWords" v-bind:word = "word" :key="word.id" v-on:word:deleted="getwords"></Word>

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
            orderedWords: function () {
                if (this.order==='asc'){
                return _.orderBy(this.words, this.sortby)
                }else return _.orderBy(this.words, this.sortby).reverse()
            }
        },
        methods: {
            getwords (page = 1) {
                axios.get('/api/dictionary', {
                    params: {
                        page: page,
                    }
                }).then((response) => {
                    console.log(response)
                    this.words = response.data.data;
                    this.meta = response.data.meta;
                })
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
            },
            reverse: function() {
                return this.orderedWords().reverse();
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
</style>
