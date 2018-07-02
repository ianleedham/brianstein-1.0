<template lang="html">

        <tr>
            <td>{{word.english}}</td>
            <td>{{word.cantonese}}</td>
            <td>{{word.jyutping}}</td>
            <td class="col-md-1" >
                <audio ref="audioElm" :src="'/storage/sounds/' + word.soundAddress + '.mp3'"></audio>
                <img v-on:click="play" class="btn play-button"  src="/storage/images/Play-Button-PNG-Picture.png"  type="button"/>
            </td>

            <td>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" data-toggle="dropdown"  style="
                                        padding-left: 2px;
                                        padding-right:  1px;
                                    width: 30px;
                                    height: 30px;
                                    background-size: 10px 10px;">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="btn btn-danger" v-on:click.prevent="Delete">
                                delete
                            </a>
                        </li>
                        <li>
                            <a class="btn " v-bind:href=url>
                                Edit
                            </a>
                        </li>
                    </ul>

                </div>
            </td>
        </tr>
</template>

<script>
    export default {
        props: ['word'],
        data() {
            return {
            }
        },
        methods: {
            play: function (event) {
                this.$refs.audioElm.play();
            },
            Delete: function (event) {
                axios.delete('/api/dictionary/'+this.word.id, {
                    params: {
                        id: this.word.id,
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1NDE3NDE3MDdlNWFlZGE3MWUxMGU2NmYxNzk2MmY0MzIzYmZhNTEyMTI3Nzg1YmE0ZmM1Nzk2MWRmZGYwOWFmMmUwOWZmNGE1ODhkMzM4In0.eyJhdWQiOiIyIiwianRpIjoiYTU0MTc0MTcwN2U1YWVkYTcxZTEwZTY2ZjE3OTYyZjQzMjNiZmE1MTIxMjc3ODViYTRmYzU3OTYxZGZkZjA5YWYyZTA5ZmY0YTU4OGQzMzgiLCJpYXQiOjE1MjY4MzcxMDEsIm5iZiI6MTUyNjgzNzEwMSwiZXhwIjoxNTU4MzczMTAxLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.Q0MNJn9W6wB67Ty2CIevG7bXzZCzNO0XxGtl9JqaYd9luC39eCFD8pbzTkT_YgXoL5CjiV0LjV8NbMBOYMZ26LsWNzeku05nIv92zFkbHJBiv2OTWLVBIZ4e39jFp6gLat--SkdJaOBAPheiSFJEwSIaTA1VbsveM4LtsaUAs0UKsuOJEjnkx3yUiahg8W32JC19MT5P1osD7ckes8rnA_XDjgvKbBPb1FlhAR3yN3KNNQjiQV_pqjJrwyGW-RKvxG3_YvUJAyzPW9f7Y9sTDKxeQDIPZ8b8quWlWaSVO93wtd6evmhq_YMWsecojyqh1kxb1Uosq-oblyJL3lpgqE45RdbKlWZDW6ObvHcdC_tFMx2CTgnhf99rrKPcQIQ8QO9wG4j8O_uQh17OjPnNz7FVh-2HHPCTLp5m-tsHjKu6H2ewBSK6PNrHp7cxjF8VI28OkcJz-kzSc3zTA5L3SPElcSxC036xlVT6SsW-oEBZus2KLwBeZB1JzzpgyXPshGy3ZQZL0tXmr7t-boU5dvw4EIsP11V-WjyBoEbbMajzGSbJ8BaIu663XktFm_tGBk9objmV0AD0Yzigrleq3Cavph9_5FT4GvSXResMk3pI1m7Cbsq6feCC6EHXMwcLu9ZD0nXt0TJfk1vEPTfgbpoO8ED8uKWAsZUC9x5v6uY"
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
            url () {
                return '/dictionary/'+this.word.id+'/edit'
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
</style>
