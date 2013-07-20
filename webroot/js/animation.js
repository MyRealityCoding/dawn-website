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

var WALKER_COUNT = 50;
var CLOUD_COUNT = 10;

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
var zombieImage3 = new Image();
zombieImage3.src = "webroot/img/zombie3.png";
var zombieImage4 = new Image();
zombieImage4.src = "webroot/img/zombie4.png";
var shadow = new Image();
shadow.src = "webroot/img/shadow.png";
var cloudImage1 = new Image();
cloudImage1.src = "webroot/img/cloud1.png";
var cloudImage2 = new Image();
cloudImage2.src = "webroot/img/cloud2.png";
var cloudImage3 = new Image();
cloudImage3.src = "webroot/img/cloud3.png";

var background = new Array();
var walkers = new Array();
var clouds = new Array();
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
    renderArray(clouds, delta);
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


function Cloud() {
    
    var image = cloudImage1;
    
    var result = Math.round(Math.random() * 2);
    
    switch (result) {
        case 0:
            image = cloudImage1;
            break;
        case 1:
            image = cloudImage2;
            break;
        case 2:
            image = cloudImage3;
            break;
    }
    
    this.speed = 0.3 * Math.random();
    this.initialWaitTime = this.waitTime;
    
    var randWidth = 50 + 50 * Math.random();
    var randHeight = 20 + 20 * Math.random();
    
    
    Sprite.call(this, image, canvas.width * Math.random(), Math.random() * 220 + 270, randWidth, randHeight);
    
    this.update = function(delta) {
         
        this.x += this.speed;

        if (this.x > canvas.width) {
            this.x = -this.width;
            this.y = Math.random() * 220 + 270;
        }
         
    }
}


function Walker() {
    
    var randomSize = 15 * Math.random();
    
    this.leftMode = Math.random() < 0.5;
    
    this.waitTime = 150000 * Math.random();
    this.initialWaitTime = this.waitTime;
    
    if (this.leftMode) {
        if (Math.random() < 0.5) {
            Sprite.call(this, zombieImage1, 0, 400 + randomSize, 50 - randomSize, 70 - randomSize);
        } else {
            Sprite.call(this, zombieImage2, 0, 400 + randomSize, 50 - randomSize, 70 - randomSize);
        }
    } else {
        if (Math.random() < 0.5) {
            Sprite.call(this, zombieImage3, canvas.width, 400 + randomSize, 50 - randomSize, 70 - randomSize);
        } else {
            Sprite.call(this, zombieImage4, canvas.width, 400 + randomSize, 50 - randomSize, 70 - randomSize);
        }
    }
    
    this.speed = 0.04 + 0.2 * Math.random();
    
    this.walkTime = 0;
    
    this.update = function(delta) {
        
        this.waitTime -= delta;
        
        if (this.waitTime < 1) {
            this.walkTime+=0.1 * Math.random();
            var factor = this.speed + Math.abs(Math.sin(this.walkTime));
            if (this.leftMode) {
                this.x += factor;
            } else {
                this.x -= factor;
            }
        }
        
        if (this.leftMode && this.x > canvas.width) {
            this.x = -(this.width);
            this.waitTime = this.initialWaitTime;
        } else if (this.x + this.width < 0) {
            this.x = canvas.width;
            this.waitTime = this.initialWaitTime;
        }

    };

}

extend(Sprite, Walker);
extend(Sprite, Cloud);

/* START */

function init() {
    
    var sky = new Sprite(skyImage, 0, 0, 720, 480);
    var shade = new Sprite(shadow, 0, 0, 720, 480);
    var mountain1 = new Sprite(mountainImage1, 0, 290, 720, 200);
    var mountain2 = new Sprite(mountainImage2, 0, 180, 720, 300);
    
    background = new Array(sky, mountain2);
    
    for (var i = 0; i < WALKER_COUNT; ++i) {
        walkers[i] = new Walker();
    }
    
    for (var i = 0; i < CLOUD_COUNT; ++i) {
        clouds[i] = new Cloud();
    }
    
    foreground = new Array(mountain1, shade);
    
    renderingLoop();
}

init();