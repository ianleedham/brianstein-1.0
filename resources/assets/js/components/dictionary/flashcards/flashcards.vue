<template>
    <p>jyutping</p>
    <p>english x 3</p>
    <p>sound</p>
</template>

<script>
    export default {
        data() {
            return {
                dictionary: [],
                dictionary_length: 1,
                cantonese: ""
            }
        },
        methods: {
            getwords() {
                axios.get('/api/whole-dictionary', {
                    params: {}
                }).then((response) => {
                    console.log(response)
                    this.words = response.data.data;
                    this.words.length = this.dictionary-length

                })
            },
            mounted () {
                this.getwords()
            },
        }
    }
</script>