<script>
    import modal from '../partials/modal.vue';

    export default {
        name: 'app',
        components: {
            modal,
        },
        data () {
            return {
                isModalVisible: false,
            };
        },
        methods: {
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
    };
</script>

<template>
    <div id="app">
        <button
                type="button"
                class="btn btn-primary"
                @click="showModal"
        >
            Open Modal!
        </button>

        <modal
                v-show="isModalVisible"
                @close="closeModal"
        >
            <audio ref="audioElm" :src="'/storage/sounds/' + 'sam' + '.mp3'"></audio>
            <p slot="cantonese">广东话; 廣東話</p>
            <p slot="english">english</p>
            <p slot="jyutping">jytping</p>
            <div slot="footer">
                <p> details: hhkhjvj jjhgvkh hvjdggljgb hfgkjhjkhftdfy hrteryukjljgteyrdv hfueghggjtdgjkgjgc</p>
            </div>
        </modal>
    </div>
</template>
