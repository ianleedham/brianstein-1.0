<template lang="html">

        <tr>
            <td>{{word.english}}</td>
            <td>{{word.cantonese}}</td>
            <td>{{word.jyutping}}</td>
            <td>
                <audio ref="audioElm" :src="'/storage/sounds/' + word.soundAddress + '.mp3'"></audio>
                <img v-on:click="play"class="img-responsive btn play-button"  src="/storage/images/Play-Button-PNG-Picture.png"  type="button"/>
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
                            <a href="#">
                                delete
                            </a>
                        </li>

                        <li>
                            edit
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
        }
    }
</script>

<style lang="css">
    .dictionary-word {
        padding: 1rem;
    }

    .chat-message > p {
        margin-bottom: .5rem;
    }
</style>
