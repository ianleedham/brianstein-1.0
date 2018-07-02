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
                class="btn"
                @click="showModal"
        >
            Open Modal!
        </button>

        <modal
                v-show="isModalVisible"
                @close="closeModal"
        >
            <p slot="header">testing hoping for slot one?</p>
            <h3 slot="body">maybe slot two?</h3>
        </modal>
    </div>
</template>
