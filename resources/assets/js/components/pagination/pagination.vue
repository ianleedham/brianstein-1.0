<template >
    <nav>
    <ul class="pagination">
        <li class=" page-item" v-bind:class="{'disabled':meta.current_page ===1}">
            <a class="page-link" v-on:click.prevent="switched(meta.current_page -1)">&laquo;</a>
        </li >
        <template v-if="section>1">
            <li class=" page-item" >
                <a class="page-link" v-on:click.prevent="switched(1)">1</a>
            </li>
            <li class=" page-item" >
                <a class="page-link" v-on:click.prevent="gobackasection">...</a>
            </li>
        </template>
        <li class=" page-item" v-for="page in pages" v-bind:class="{active:meta.current_page === page}">
            <a class="page-link" v-on:click.prevent="switched(page)">{{page}}</a>
        </li>
        <template v-if="section<sections">
            <li class=" page-item" >
                <a class="page-link" v-on:click.prevent="goforwardasection">...</a>
            </li>
            <li class=" page-item" >
                <a class="page-link" v-on:click.prevent="switched(meta.last_page)">{{meta.last_page}}</a>
            </li>
        </template>
        <li class=" page-item" v-bind:class="{'disabled':meta.current_page ===meta.last_page}">
            <a class="page-link" v-on:click.prevent="switched(meta.current_page +1)">&raquo;</a>
        </li>
    </ul>
    </nav>
</template>

<script>
    export default {
        props: ['meta'],
        data () {
            return {
                numbersPerSection: 10
            }
        },
        computed: {
            sections (){
                return Math.ceil(this.meta.last_page / this.numbersPerSection)
            },
            section (){
                return Math.ceil(this.meta.current_page / this.numbersPerSection)
            },
            pages () {
                return _.range(this.first_page ,this.last_page)
            },
            first_page () {
                return (this.section-1) * this.numbersPerSection + 1
            },
            last_page () {
                let last_page = (this.section - 1)*this.numbersPerSection + this.numbersPerSection
                if(this.section ===this.sections){
                    last_page = this.meta.last_page
                }
                return last_page + 1
            }
        },
        methods: {
            switched: function (page) {
                if (page <= 0 || page > this.meta.last_page){return}
                this.$emit('pagination:switched', page)
            },
            goforwardasection: function () {
                this.switched(
                    this.firstpageofsection(this.section +1)
                )
            },
            gobackasection: function () {
                this.switched(
                    this.firstpageofsection(this.section - 1)
            )
            },
            firstpageofsection: function (section) {
                return ((section - 1) * this.numbersPerSection + 1)
            }
        }

    }
</script>