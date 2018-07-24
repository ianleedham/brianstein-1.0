<template>
    <div class="typed_answer row">
    <div class="col-md-10 ">
        <div class="row">
            <img class="question-image" src="/storage/images/Screenshot_2018-07-17Garden-Memrise.png">
            <h1  class="question" >{{question.prompt.text.value}}</h1>
        </div>
        <p class="statment">
            Type the <b>English</b> for the <b>Cantonese</b> above and press Enter:
        </p>
        <div class="row">
            <input v-model="answer" v-on:keyup.enter="checkAnswer()" class="input-field form-control" type="text" >
        </div>
        {{answer}}
    </div>
        <button
                class="btn col-md-2 custom-btn"
        >
            check
        </button>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        data () {
            return {
                wronganswer: '星期一',
                answer: ''
            }
        },
        methods: {
            checkAnswer(){
                this.$emit('question:answered',this.answer === this.question.correct[0]);

            }
        }
    }
</script>

<style>
    .typed_answer{
        margin-top: 50px;

    }
    .question {
        height: 70px;
        font-size: 70px;
        margin-left: 20px;

    }
    .question-image{
        height: 70px;
    }
    .input-field{
        width: 100%;
    }
    .custom-btn{
        padding-top: 60px; height: 90px
    }







</style>