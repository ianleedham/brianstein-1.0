<script>
    export default {
        name: 'modal',
        methods: {
            close() {
                this.$emit('close');
            },
            play: function (event) {
                this.$refs.audioElm.play();
            },
        },
    };
</script>
<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="modal box col-md-6"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                <header
                        class="modal-header"
                        id="modalTitle"
                >
                    <slot name="header">

                        level: 1
                        <button class="btn btn-primary">add to custom list</button>

                    </slot>
                    <button
                            type="button"
                            class="btn-close"
                            @click="close"
                            aria-label="Close modal"
                    >
                        x
                    </button>
                </header>
                <section
                        class="modal-body"
                        id="modalDescription"
                >
                    <div class="row">
                        <div class="col">
                            <p class="cantonese-slot">
                                <slot name="cantonese" >
                                    广东话; 廣東話
                                </slot>
                            </p>
                            <slot name="sound">
                                <audio ref="audioElm" :src="'/storage/sounds/' + 'sam' + '.mp3'"></audio>
                            </slot>
                            <img v-on:click="play" class="btn play-button"  src="/storage/images/Play-Button-PNG-Picture.png"  />

                        </div>
                        <div class="col">
                            <p  class="jyutping-slot" >
                                <slot name="jyutping" class="jyutping-slot" style="font-size: 20px">
                                    jyutping
                                </slot>
                            </p>
                            <p class="english-slot">

                                <slot name="english" >
                                    english
                                </slot>
                            </p>

                        </div>

                    </div>
                </section>
                <footer class="modal-footer">
                    <slot name="footer">
                        <p> details: hhkhjvj jjhgvkh hvjdggljgb hfgkjhjkhftdfy hrteryukjljgteyrdv hfueghggjtdgjkgjgc</p>
                    </slot>
                </footer>

            </div>
        </div>
    </transition>
</template>
<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
    }


    @media only screen and (min-width: 768px) {
        /* tablets and desktop */
        .modal {
            background: #FFFFFF;
            box-shadow: 2px 2px 20px 1px;
            overflow-x: auto;
            display: flex;
            flex-direction: column;
            margin: 10% auto 10% auto;
        }
    }

    @media only screen and (max-width: 767px) {
        /* phones */
        .modal {
            background: #FFFFFF;
            box-shadow: 2px 2px 20px 1px;
            overflow-x: auto;
            display: flex;
            flex-direction: column;
            margin-bottom: 30%;
            margin-top: 100px;
        }
    }

    @media only screen and (max-width: 767px) and (orientation: portrait) {
        /* portrait phones */
    }



    .modal-header{
        padding: 15px;
        display: flex;
    }
    .modal-footer {
        padding: 15px;
    }

    .modal-header {
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        justify-content: space-between;
    }


    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        border: none;
        font-size: 20px;
        padding: 20px;
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .btn-green {
        color: white;
        background: #4AAE9B;
        border: 1px solid #4AAE9B;
        border-radius: 2px;
    }

    .cantonese-slot, .jyutping-slot, .english-slot {
        font-size: 35px;
    }

    .play-button {
        max-width: 90px;
        margin: 1% auto 1% auto;
    }
</style>
