<script>
    export default {
        props: ['word'],
        name: 'modal',
        methods: {
            close() {
                this.$emit('close');
            },
            play: function (event) {
                this.$refs.audioElm.play();
            },
            Delete: function (event) {

                    console.log('word deleted');
                    this.$emit('word:deleted', 1)//todo check this

            },
        },
        computed: {
            url () {
                return '/dictionary/'+this.word.id+'/edit'
            }
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
<!--

                        level: 1
                        <button class="btn btn-primary">add to custom list</button>
-->

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
                                <slot name="audio"></slot>
                            </p>
                            <slot name="sound"></slot>

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
                    <a class="btn btn-danger bn" v-on:click.prevent="Delete">
                        delete
                    </a>
                    <a class="btn bn" v-bind:href=url>
                        Edit
                    </a>
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
        z-index: 2;
    }
.modal{
    z-index: 3;
}

    @media only screen and (min-width: 768px) {
        /* tablets and desktop */
        .modal {
            background: #FFFFFF;
            box-shadow: 2px 2px 20px 1px;
            overflow-x: auto;
            display: flex;
            flex-direction: column;
            margin: 2rem auto 2rem auto;
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

    .bn{
        margin-left: auto;
        margin-right: auto;
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
