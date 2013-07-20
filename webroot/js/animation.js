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
    
    sprites = new Array(sky);
    
    
    renderingLoop();
}

init();