<script>
    import modal from '../partials/modal.vue';

    export default {
        name: 'app',
        components: {
            modal,
        },
        props: ['word'],
        data () {
            return {
                isModalVisible: false,
                soundAddress: null

            };
        },
        methods: {
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            },
            play: function (event) {
                this.$refs.audioElm.play();
            },
        },
        computed: {
            shouldHaveAudio() {
                this.soundAddress = this.word.soundAddress
                if(this.word.soundAddress  !== null){
                    console.log(this.soundAddress)
                    return true
                }else return false
            }
        }
    };
</script>

<template>
    <div id="app">
        <button
                type="button"
                class="btn btn-primary"
                @click="showModal"
        >
            More Info
        </button>

        <modal
                v-show="isModalVisible"
                @close="closeModal"
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
    </div>
</template>
