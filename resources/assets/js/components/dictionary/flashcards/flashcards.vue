<template>
    <div v-if="test_word&&random_words">
    <h1>{{test_word.jyutping}}</h1>
        <button class="btn btn-primary" v-on:click.prevent="word_clicked(0)" ref="english_one">{{random_words[0].english}}</button>
        <button class="btn btn-primary" v-on:click.prevent="word_clicked(1)" ref="english_two">{{random_words[1].english}}</button>
        <button class="btn btn-primary" v-on:click.prevent="word_clicked(2)" ref="english_three">{{random_words[2].english}}</button>

    <p>sound</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                dictionary: [],
                dictionary_length: 50,
                rand_num: [1,2,3],
                random_numbers:[]
            }
        },
        computed: {

            random_words(){
                return [
                    this.dictionary[this.random_numbers[0]],
                    this.dictionary[this.random_numbers[1]],
                    this.dictionary[this.random_numbers[2]]
                ]
            },

            test_word(){
                return this.random_words[this.random_numbers[3]]
            },
        },
        methods: {
            getwords() {
                axios.get('/api/whole-dictionary', {
                    params: {}
                }).then((response) => {
                    console.log(response);
                    this.dictionary = response.data.data;
                    this.dictionary_length= this.dictionary.length;
                    console.log(this.dictionary_length);


                })
            },
            word_clicked(Index=0) {
                if (this.random_numbers[3]===Index){

                this.generate_random_numbers();}
            },
            generate_random_numbers(){
                var numberOne = Math.floor(Math.random()*this.dictionary_length);
                var numberTwo = Math.floor(Math.random()*this.dictionary_length);
                var numberThree = Math.floor(Math.random()*this.dictionary_length);

// run this loop until numberOne is different than numberThree
                do {
                    numberOne = Math.floor(Math.random()*this.dictionary_length);
                } while(numberOne === numberThree);

// run this loop until numberTwo is different than numberThree and numberOne
                do {
                    numberTwo = Math.floor(Math.random()*this.dictionary_length);
                } while(numberTwo === numberThree || numberTwo === numberOne);

                this.random_numbers = [
                    numberOne,
                    numberTwo,
                    numberThree,
                    Math.floor(Math.random()*2+1),
                ];
            },
        },
        mounted () {
           this.getwords();
           this.generate_random_numbers()
        },
    }
</script>