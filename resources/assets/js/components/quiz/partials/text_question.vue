<template>
  <div class="text_question col-md-6">
      <div class="row">
      <img class="question-image" src="/storage/images/Screenshot_2018-07-17Garden-Memrise.png">
          <h1  class="question"  style="margin-left: 50px">{{question.prompt.text.value}}</h1>
      </div>
      <p class="statment">pick the correct answer</p>
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <h4 class="answer rounded circle border " v-on:click=checkAnswer(answer_0)>1. {{answer_0}}</h4>
        <h4 class="answer rounded circle border " v-on:click="checkAnswer(answer_1)">3. {{answer_1}}</h4>
      </div>
      <div class="col-md-6 col-lg-6">
        <h4 class="answer rounded circle border" v-on:click="checkAnswer(answer_2)">2. {{answer_2}}</h4>
        <h4 class="answer rounded circle border" v-on:click="checkAnswer(answer_3)">4. {{answer_3}}</h4>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['question'],
        data () {
            return {
                randomNumber: 0,
            }
        },
        methods: {
            checkAnswer(clicked){
                this.randomNumber = Math.floor(Math.random()*4);
                this.$emit('question:answered',clicked === this.question.correct[0]);
            }
        },
        computed: {
            // if random number is 0 then return the correct answer else return the first alternative.
          answer_0(){
              if (this.randomNumber===0){
                  return this.question.correct[0]
              }else return this.question.choices[0];
          },
            // if random number is 1 then return the correct answer else return the second alternative.
          answer_1(){
              if (this.randomNumber===1){
                  return this.question.correct[0]
              }else return this.question.choices[1];
          },
            // if random number is 2 then return the correct answer else return the third alternative.
          answer_2(){
              if (this.randomNumber===2){
                  return this.question.correct[0]
              }else return this.question.choices[2];
          },
            // if random number is 3 then return the correct answer else return the fourth alternative.
          answer_3(){
              if (this.randomNumber===3){
                  return this.question.correct[0]
              }else return this.question.choices[3];
          },

        },
        mounted() {
        }
    }
</script>

<style>
  .text_question{
      width: auto;
    margin: 50px;
    background-color: #F5F5F5;
  }
  .question {
      height: 70px;
      font-size: 70px;
  }
  .question-image{
      height: 70px;
  }
  .answer {
      padding: 5px;
    background-color: white;
      border-radius: 0.1rem;
      border-color: darkgray;
  }
  .answer:hover{
      cursor: pointer;
      background-color: #AA5F86;
  }






</style>