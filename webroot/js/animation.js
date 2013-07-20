/* Animates the background with mountains, zombies, clouds and vegitation
 * 
 * @author Miguel Gonzalez <miguel-gonzalez@gmx.de>
 * @since 1.0
 * @version 1.0
 */

/* INITIALIZATION */

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var intervalID = -1;
var currentTime = +new Date();
var lastTime = currentTime;
var delta = currentTime - lastTime;
var WALKER_COUNT = 20;

var skyImage = new Image();
skyImage.src = "webroot/img/sky.png";
var mountainImage1 = new Image();
mountainImage1.src = "webroot/img/mountain1.png";
var mountainImage2 = new Image();
mountainImage2.src = "webroot/img/mountain2.png";
var zombieImage1 = new Image();
zombieImage1.src = "webroot/img/zombie1.png";
var zombieImage2 = new Image();
zombieImage2.src = "webroot/img/zombie2.png";

var background = new Array();
var walkers = new Array();
var foreground = new Array();

/* MAIN LOOP */

var QueueNewFrame = function () {
    
    if (window.requestAnimationFrame)
        window.requestAnimationFrame(renderingLoop);
    else if (window.msRequestAnimationFrame)
        window.msRequestAnimationFrame(renderingLoop);
    else if (window.webkitRequestAnimationFrame)
        window.webkitRequestAnimationFrame(renderingLoop);
    else if (window.mozRequestAnimationFrame)
        window.mozRequestAnimationFrame(renderingLoop);
    else if (window.oRequestAnimationFrame)
        window.oRequestAnimationFrame(renderingLoop);
    else {
        QueueNewFrame = function () {
        };
        intervalID = window.setInterval(renderingLoop, 16.7);
    }
};

function renderArray(data, delta) {
    for (var i = 0; i < data.length; ++i) {
        var sprite = data[i];
        sprite.updateAndRender(delta);
    }
}

var renderingLoop = function () {
    
    lastTime = currentTime;
    currentTime = +new Date();       
    delta = currentTime - lastTime;
    
    context.clearRect(0, 0, canvas.width, canvas.height); 
    
    renderArray(background, delta);
    renderArray(walkers, delta);
    renderArray(foreground, delta);
    
    QueueNewFrame();
};

function surrogateCtor() {}

function extend(base, sub) {
  // Copy the prototype from the base to setup inheritance
  surrogateCtor.prototype = base.prototype;
  // Tricky huh?
  sub.prototype = new surrogateCtor();
  // Remember the constructor property was set wrong, let's fix it
  sub.prototype.constructor = sub;
}



/* CLASSES */

function Sprite(image, x, y, width, height) {
    
    this.image = image;
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;
    
    this.getLeft = function() {
        return this.x;
    }
    
    this.getTop = function() {
        return this.y;
    }
    
    this.getWidth = function() {
        return this.width;
    }
    
    this.getHeight = function() {
        return this.height;
    }
    
    this.getRight = function() {
        return this.getX() + this.getWidth();
    }
    
    this.getBottom = function() {
        return this.getY() + this.getHeight();
    }
    
    this.update = function(delta) {
        
    };
    
    this.render = function() {
        context.drawImage(this.image, this.x, this.y, this.width, this.height);
    };
    
    this.updateAndRender = function(delta) {
        this.update(delta);
        this.render();
    };
}


function Walker() {
    
    this.leftMode = Math.random() < 0.5;
    
    this.waitTime = 150000 * Math.random();
    this.initialWaitTime = this.waitTime;
    
    if (this.leftMode) {
        if (Math.random() < 0.5) {
            Sprite.call(this, zombieImage1, 0, 400, 50, 70);
        } else {
            Sprite.call(this, zombieImage2, 0, 400, 50, 70);
        }
    } else {
        if (Math.random() < 0.5) {
            Sprite.call(this, zombieImage1, 0, 400, 50, 70);
        } else {
            Sprite.call(this, zombieImage2, 0, 400, 50, 70);
        }
    }
    
    this.speed = 0.05;
    
    this.walkTime = 0;
    
    this.update = function(delta) {
        
        this.waitTime -= delta;
        
        if (this.waitTime < 1) {
            this.walkTime+=0.1 * Math.random();
            this.x += this.speed + Math.abs(Math.sin(this.walkTime));
        }
        
        if (this.x > canvas.width) {
            this.x = -(this.width);
            this.waitTime = this.initialWaitTime;
        }
    };
}

extend(Sprite, Walker);

/* START */

function init() {
    
    var sky = new Sprite(skyImage, 0, 0, 720, 480);
    var mountain1 = new Sprite(mountainImage1, 0, 290, 720, 200);
    var mountain2 = new Sprite(mountainImage2, 0, 380, 720, 90);
    
    background = new Array(sky, mountain2);
    
    for (var i = 0; i < WALKER_COUNT; ++i) {
        walkers[i] = new Walker();
    }
    
    foreground = new Array(mountain1);
    
    renderingLoop();
}

init();