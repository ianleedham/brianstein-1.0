<template lang="html">
    <div class="dictionary">
        <div v-show="words.length===0" class="empty"><p>nothing here yet</p></div>

        <!--   [{"wordid":1,"english":"Heart","jyutping":"sam","cantonese":"\u5fc3","soundAddress":"sam.3gp","type":"1","syncsts":0}-->
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th class="btn" v-on:click="changeOrder('english')" ref="english_title">
                        English
                    </th>
                    <th class=""v-on:click="changeOrder('cantonese')" >
                        Cantonese
                    </th>
                    <th class="btn" v-on:click="changeOrder('jyutping')" >
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

                <dictionary-word v-for="word in orderedWords" v-bind:word = "word" :key="word.id" ></dictionary-word>

                </tbody>
            </table>
        </div>



    </div>
</template>

<script>
    export default {
        props: ['words'],
        data() {
            return {
                sortby: 'english',
                order: 'asc',
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
            }
        }

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
