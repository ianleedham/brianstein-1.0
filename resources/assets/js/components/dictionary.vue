<template lang="html">
    <div class="dictionary">
        <!--<chat-message v-for="word in words" v-bind:word = "word"  :key="word.id"></chat-message>-->
        <!--<div v-show="words.length===0" class="empty"><p>nothing here yet</p></div>-->
    </div>
</template>

<script>
    export default {
        // props: ['words']
    }
</script>

<style lang="css">
/*    .chat-log .dictionary-message:nth-child(even) {
        background-color: #ccc;
    }*/
    .empty {
        padding: 1rem;
        text-align: center;
    }
</style>
