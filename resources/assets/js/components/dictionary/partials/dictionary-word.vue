<template lang="html">

        <tr class="dictionary-word"  >

            <td  @click="toggleModal">{{word.english}}</td>
            <td @click="toggleModal" class="col-md-3">{{word.cantonese}}</td>
            <td  @click="toggleModal" class="col-md-3">{{word.jyutping}}</td>

            <modal
                    v-on:word:deleted="Delete"
                    v-show="isModalVisible"
                    @close="toggleModal"
                    v-bind:word="word"
            >
                <p slot="cantonese">{{word.cantonese}}</p>
                <p slot="english">{{word.english}}</p>
                <p slot="jyutping">{{word.jyutping}}</p>
                <div slot="footer">
                    <p> </p>
                </div>
                <div slot="audio" v-show="shouldHaveAudio">
                    <img v-on:click="play" class="btn play-button"
                         src="/storage/images/Play-Button-PNG-Picture.png" />
                    <audio  ref="audioElm" v-show="true"  :src="'/storage/sounds/' + word.soundAddress + '.mp3'"></audio>
                </div>
            </modal>
        </tr>
</template>

<script>
    import Modal from './modal.vue';
    export default {
        props: ['word'],
        data() {
            return {
                isModalVisible: false,
                soundAddress: null
            }
        },
        components: {
          Modal
        },
        methods: {
            word_deleted() {
                this.$emit('word:deleted', 1)
            },
            showModal() {
                console.log( "show model");
                this.isModalVisible = true;
            },
            closeModal() {
                console.log( this.isModalVisible);
                this.isModalVisible = false;
                console.log( this.isModalVisible)
            },
            toggleModal() {
                if(this.isModalVisible===false){
                    this.isModalVisible = true
                }else this.isModalVisible = false
            },
            play: function (event) {
                this.$refs.audioElm.play();
            },
            Delete: function (event) {
                axios.delete('/api/dictionary/'+this.word.id, {
                    params: {
                        id: this.word.id,
                        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1NDE3NDE3MDdlNWFlZGE3MWUxMGU2NmYxNzk2MmY0MzIzYmZhNTEyMTI3Nzg1YmE0ZmM1Nzk2MWRmZGYwOWFmMmUwOWZmNGE1ODhkMzM4In0.eyJhdWQiOiIyIiwianRpIjoiYTU0MTc0MTcwN2U1YWVkYTcxZTEwZTY2ZjE3OTYyZjQzMjNiZmE1MTIxMjc3ODViYTRmYzU3OTYxZGZkZjA5YWYyZTA5ZmY0YTU4OGQzMzgiLCJpYXQiOjE1MjY4MzcxMDEsIm5iZiI6MTUyNjgzNzEwMSwiZXhwIjoxNTU4MzczMTAxLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.Q0MNJn9W6wB67Ty2CIevG7bXzZCzNO0XxGtl9JqaYd9luC39eCFD8pbzTkT_YgXoL5CjiV0LjV8NbMBOYMZ26LsWNzeku05nIv92zFkbHJBiv2OTWLVBIZ4e39jFp6gLat--SkdJaOBAPheiSFJEwSIaTA1VbsveM4LtsaUAs0UKsuOJEjnkx3yUiahg8W32JC19MT5P1osD7ckes8rnA_XDjgvKbBPb1FlhAR3yN3KNNQjiQV_pqjJrwyGW-RKvxG3_YvUJAyzPW9f7Y9sTDKxeQDIPZ8b8quWlWaSVO93wtd6evmhq_YMWsecojyqh1kxb1Uosq-oblyJL3lpgqE45RdbKlWZDW6ObvHcdC_tFMx2CTgnhf99rrKPcQIQ8QO9wG4j8O_uQh17OjPnNz7FVh-2HHPCTLp5m-tsHjKu6H2ewBSK6PNrHp7cxjF8VI28OkcJz-kzSc3zTA5L3SPElcSxC036xlVT6SsW-oEBZus2KLwBeZB1JzzpgyXPshGy3ZQZL0tXmr7t-boU5dvw4EIsP11V-WjyBoEbbMajzGSbJ8BaIu663XktFm_tGBk9objmV0AD0Yzigrleq3Cavph9_5FT4GvSXResMk3pI1m7Cbsq6feCC6EHXMwcLu9ZD0nXt0TJfk1vEPTfgbpoO8ED8uKWAsZUC9x5v6uY'
                    }
                }).then((response) => {
                    this.$emit('word:deleted', 1)
                })
            },
            Edit: function (event) {
                axios.get('/dictionary/'+this.word.id+'/edit')
            }
        },
        computed: {
            shouldHaveAudio() {
                this.soundAddress = this.word.soundAddress
                if (this.word.soundAddress !== null) {
                    console.log(this.soundAddress)
                    return true
                } else return false
            }

        }
    }
</script>

<style lang="css">
    .play-button {
        max-width: 50px;
    }

    .chat-message > p {
        margin-bottom: .5rem;
    }
    .col-md-3{
        width: 25%;
    }

    .dictionary-word{
        cursor: pointer;
        z-index: 1;
    }
</style>
