<template>
    <div class="word-composer text-center">

        <h1>Create Word</h1>
        <div class="form-group">
            <input class="input" v-model="english" placeholder="English"/>
        </div>
        <div class="form-group ">
            <input class="input" v-model="cantonese" placeholder="Cantonese"/>
        </div>
        <div class="form-group ">
            <input class="input" v-model="jyutping" placeholder="Jyutping"/>
        </div>
        <div class="form-group ">
            <textarea class="input" v-model="description" placeholder="description"></textarea>
        </div>
        <button v-on:click="submit">submit</button>

    </div>
</template>

<script>
    export default {
        props: ["user"],
        data() {
            return {
                english: "",
                cantonese: "",
                jyutping: "",
                description: "",
            }
        },
        methods: {
            submit: function(){
                //console.log(this.user.id);

                const data = {
                    name: 'Token Name',
                    scopes: [],
                    english: this.english,
                    jyutping: this.jyutping,
                    cantonese: this.cantonese,
                    description: this.description,
                    user_id: this.user,

                    params: {
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1NDE3NDE3MDdlNWFlZGE3MWUxMGU2NmYxNzk2MmY0MzIzYmZhNTEyMTI3Nzg1YmE0ZmM1Nzk2MWRmZGYwOWFmMmUwOWZmNGE1ODhkMzM4In0.eyJhdWQiOiIyIiwianRpIjoiYTU0MTc0MTcwN2U1YWVkYTcxZTEwZTY2ZjE3OTYyZjQzMjNiZmE1MTIxMjc3ODViYTRmYzU3OTYxZGZkZjA5YWYyZTA5ZmY0YTU4OGQzMzgiLCJpYXQiOjE1MjY4MzcxMDEsIm5iZiI6MTUyNjgzNzEwMSwiZXhwIjoxNTU4MzczMTAxLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.Q0MNJn9W6wB67Ty2CIevG7bXzZCzNO0XxGtl9JqaYd9luC39eCFD8pbzTkT_YgXoL5CjiV0LjV8NbMBOYMZ26LsWNzeku05nIv92zFkbHJBiv2OTWLVBIZ4e39jFp6gLat--SkdJaOBAPheiSFJEwSIaTA1VbsveM4LtsaUAs0UKsuOJEjnkx3yUiahg8W32JC19MT5P1osD7ckes8rnA_XDjgvKbBPb1FlhAR3yN3KNNQjiQV_pqjJrwyGW-RKvxG3_YvUJAyzPW9f7Y9sTDKxeQDIPZ8b8quWlWaSVO93wtd6evmhq_YMWsecojyqh1kxb1Uosq-oblyJL3lpgqE45RdbKlWZDW6ObvHcdC_tFMx2CTgnhf99rrKPcQIQ8QO9wG4j8O_uQh17OjPnNz7FVh-2HHPCTLp5m-tsHjKu6H2ewBSK6PNrHp7cxjF8VI28OkcJz-kzSc3zTA5L3SPElcSxC036xlVT6SsW-oEBZus2KLwBeZB1JzzpgyXPshGy3ZQZL0tXmr7t-boU5dvw4EIsP11V-WjyBoEbbMajzGSbJ8BaIu663XktFm_tGBk9objmV0AD0Yzigrleq3Cavph9_5FT4GvSXResMk3pI1m7Cbsq6feCC6EHXMwcLu9ZD0nXt0TJfk1vEPTfgbpoO8ED8uKWAsZUC9x5v6uY",
                    }
                };
                //console.log(data)

                axios.post('/api/dictionary/', data)
                    .then((response) => {
                        console.log(response)
                    })
            }
        }
    }
</script>

<style>
 .word-composer{
     border-radius: 1px;
     border: solid #0b2e13;
     padding: 1rem;
     margin: auto 25% ;
 }
    .input{
        display: block;
        width:100%;
    }
</style>