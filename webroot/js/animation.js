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

var skyImage = new Image();
skyImage.src = "webroot/img/sky.png";
var mountainImage1 = new Image();
mountainImage1.src = "webroot/img/mountain1.png";

var sprites = new Array();

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

var renderingLoop = function () {
    
    lastTime = currentTime;
    currentTime = +new Date();       
    delta = currentTime - lastTime;
    
    context.clearRect(0, 0, canvas.width, canvas.height); 
    
    for (var i = 0; i < sprites.length; ++i) {
        var sprite = sprites[i];
        sprite.updateAndRender(delta);
    }
    
    QueueNewFrame();
};



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



/* START */

function init() {
    
    var sky = new Sprite(skyImage, 0, 0, 720, 480);
    var mountain1 = new Sprite(mountainImage1, 0, 0);
    
    sprites = new Array(sky, mountain1);
    
    renderingLoop();
}

init();