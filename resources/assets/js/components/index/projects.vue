<template>
    <div>
        <div class="portfolio ">
            <div class="tall portfolio-item  one" v-on:click="scrollToDictionary('#mobDictionary')">
                <div>Cantonese Dictionary mobile App</div>
                <div>My first real programming project</div>
            </div>
            <div class="large portfolio-item five" v-on:click="scrollToDictionary('#vueDictionary')" >
                <div class="portfolio-item-title">Cantonese Dictionary vue component</div>
                <div class="portfolio-item-body"> The counterpart to the mobile version</div>
            </div>
            <div class="small-tall portfolio-item three" v-on:click="scrollToDictionary('#arcadeGame')">Arcade Game</div>
            <div class="medium portfolio-item four" v-on:click="scrollToDictionary('#canvas')" >
                <h3>
                    A canvas element graphic.
                </h3>
            </div>
            <div class="large-wide portfolio-item  two" v-on:click="scrollToDictionary('#TravellingMuse')">
                <div class="portfolio-item-title">Travellingmuse - ongoing</div>
                <div class="portfolio-item-body">
                    A client wanted a forum for joining travellers
                    together to share stories, ideas and local knowledge
                </div>
            </div>
        </div>




        <div class="projects">
            <div class="travellingmuse" id="TravellingMuse">
                <h1>TravellingMuse - ongoing</h1>
                <img class="" src="storage/websiteImages/TravellingMuse.png">
                <p>
                    I am Building this because a friend found wordpress to constricting for all the styles and
                    components they wanted to impliment
                </p>
                <h4>
                    Features of Travelling Muse website:
                </h4>
                <div class="row">
                        <ul class="col-md-6">
                            <li>Laravel and vue</li>
                            <li>Blog</li>
                            <li>Vue.js and google Map</li>
                            <li>Vue.js podiums</li>
                            <li>Custom font</li>
                        </ul>

                        <ul class="col-md-6">
                            <li>responsive Bootstrap</li>
                            <li>Social media apis</li>
                            <li>Gallery</li>
                            <li>Contact via email</li>
                            <li>Google analytics</li>
                        </ul>
                </div>
                <a class="row" href="http://dev.travellingmuse.co.uk"><button>Go to Travellingmuse.co.uk</button></a>
            </div>

            <div class="dictionary-app" id="mobDictionary" >
                <h1>Mobile cantonese dictionary</h1>
                <img class="img-tall" src="storage/websiteImages/Screenshot_20180615-133656.jpg">
                <img class="img-tall" src="storage/websiteImages/Screenshot_20180615-133640.jpg">
                <img class="img-wide" src="storage/websiteImages/androidstudio.png">
                <div class="row">
                    <ul class="col-md-6">
                        <li>
                            Features of dictionary:
                        </li>
                        <li>
                            Android studio using Java, Xml http calls and Sqlite
                        </li>
                        <li>
                            Built which Going through my android studio scholarship
                        </li>
                        <li>
                            Fragments
                        </li>
                    </ul>
                    <ul class="col-md-6">
                        <li>
                            Side pannel
                        </li>
                        <li>
                            Has full CRUD functionality
                        </li>
                        <li>
                            Used both Mysql with api on this website and Sqlite so it works offline
                        </li>
                        <li>
                            Adapters and work objects
                        </li>
                        <li>
                            Shows different types of words on different pages
                        </li>
                    </ul>
                </div>
            </div>

            <div class="vue-dictionary"  ref="vueDictionary"  id="vueDictionary">
                <h2>Cantonese Dictionary in Vue.js</h2>
                <img class="" src="storage/websiteImages/CantoneseDictionary.png">
                <p>
                    Connects using axios to the same database as the mobile version.
                </p>
                <p>
                    Has full crud functionality meaning I can add, edit and delete words  after logging in.
                </p>
                <p>
                    Has pagination which is a separate component which can be used for anything requiring pagination in vue.js
                </p>
                <p>
                    Each word can fill a modal with information when clicked on.
                </p>
                <a class="" href="/vue-dictionary"><button>Go to the vue dictionary</button></a>
            </div>
            <div class="canvas" id="canvas">
                <h2>Graphical canvas bubbles</h2>
                <p>
                    Written when first learning js and canvas it is good because it shows a little of what is
                    possible using canvas. It was interesting to write the logic so the bubbles bounce off the
                    sides and react to the mouse.
                </p>
                <img class="" src="storage/websiteImages/canvas-bubbles.png">
                <a class="row" href="https://canvas.brianstein.co.uk/"><button>Go to the canvas</button></a>
            </div>
            <div class="arcadegame" id="arcadeGame">
                <h2>Arcade game</h2>
                <p>
                    I experimented with a game engine and created an arcade game.
                    Shows a little of the programming required which when extrapolated can create a large in-depth game
                    https://arcade-game.brianstein.co.uk/
                </p>
                <img class="" src="storage/websiteImages/arcadegame.png">
                <a class="row" href="https://arcade-game.brianstein.co.uk/"><button>Go to the arcade game</button></a>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        methods: {
            scrollToDictionary(divRef = '#vueDictionary') {
                //console.log('click');
                var divContainer = this.$el.querySelector(divRef);
               // document.getElementById("#divId").scrollTop = 0;
                //this.$refs.vueDictionary.scrollTop = 0;
                //var divContainer = this.$refs.;
                divContainer.scrollIntoView();// = divContainer.scrollHeight;
                //window.scrollTo(0, 0);
            }
        },

    }
</script>