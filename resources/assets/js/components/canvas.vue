<template>
    <canvas  style="width: 100%; height: 600px;" ref="brian_canvas"></canvas>
</template>

<script>
    var canvas = this.$refs['brian_canvas'];
    this.$refs['brian_canvas'].width = window.innerWidth;
    this.$refs['brian_canvas'].height = window.innerHeight;

    var c = canvas.getContext('2d');
    var Mouse = {
        x: undefined,
        y: undefined	}
    var maxRadius = 50;
    var minRadius = 3;
    var colourArray = [
        '#02547D',
        '#0284A8',
        '#02BEC4',
        '#A9E8DC',
        '#E1F7E7']

    window.addEventListener('mousemove',function (event) {
        Mouse.x = event.clientX;
        Mouse.y = event.clientY;
        //console.log(Mouse);
    })

    window.addEventListener('resize', function () {

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        init()
    })

    function Circle(x,y,dx,dy,radius) {
        //get all parameters
        this.x = x;
        this.y = y;
        this.dx = dx;
        this.dy = dy;
        this.radius = radius;
        this.colour = colourArray[Math.floor(Math.random() * colourArray.length)]
        this.minRadius = radius;
        //draw the circle
        this.draw = function () {
            c.beginPath();
            c.arc(this.x,this.y,this.radius,0, Math.PI*2,false);
            c.stroke();
            c.fill();
            c.fillStyle = this.colour;
        }
        this.update = function () {
            this.x += this.dx;	//moves x direction
            this.y += this.dy;	//moves y direction
            if (this.x>innerWidth-this.radius || this.x < this.radius)
            {this.dx=-this.dx;} //bounce off left or right walls
            if (this.y>innerHeight-this.radius || this.y <this.radius)
            {this.dy=-this.dy;}	//bounce off top or bottom

            //interactivity
            if(Mouse.x - this.x < 100 && Mouse.x - this.x > -50
                && Mouse.y - this.y < 100 && Mouse.y - this.y > -50 && this.radius < maxRadius)
            {this.radius += 3;}else if (this.radius > this.minRadius){this.radius -=1;}


            this.draw();	//draw it via draw function
        }
    }
    //create an array for the circle objects
    var circleArray=[];
    init();
    //functions

    function init() {

        circleArray = []
//create circle objects and add them to the array
        for (var i =0; i<1000; i++) {
            var radius =Math.random() * 10 +1 ;
            var x = Math.random() *(window.innerWidth-radius*2)+radius;
            var y = Math.random() *(window.innerHeight-radius*2)+radius;
            var dx = (Math.random() -.5)*4;
            var dy = (Math.random()- .5)*4;

            circleArray.push( new Circle(x,y,dx,dy,radius));

        }

    }

    function animate() {
        requestAnimationFrame(animate);
        c.clearRect(0,0,innerWidth,innerHeight);
        for (var i = 0; i < circleArray.length; i++){
            circleArray[i].update();	//call update function for each circle object
        }
    }

    animate();
</script>

<style type="text/css">
    canvas {
        border: 1px solid;
    }
    body {margin: 0px;}
</style>
