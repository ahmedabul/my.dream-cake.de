const Welle = require('../class/welle');
const Kreise = require('../class/kreis');

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}

var c = document.getElementById("homeCanvas");
c.width = 1100;
c.height = 300;
var context = c.getContext('2d');
var kreisen = [];
var farben = ['#2185C5', '#7ECEFD', '#FFF6E5', '#FF7F66'];
const canvasWidth = c.width * 2;
const canvasHeight = c.height * 2;
var x = 0;
var canvasAlpha = 0;
for (var i = 0; i <= 500; i++) {
    kreisen.push(new Kreise(getRandomInt(0, c.width * 2) - (canvasWidth / 2), getRandomInt(0, c.height * 2) - (canvasHeight / 2), Math.random(), farben[getRandomInt(0, 4)]));
}
animation();

function animation() {
    requestAnimationFrame(animation);

    if (x <= c.width) {
        x += 3;
        context.fillStyle = "rgba(0, 0, 0, 0.1)";
        context.fillRect(0, 0, c.width, c.height);
        new Welle(x, c, 0.01, 50).moveWelle(c, context);
    } else {
        canvasAlpha += 0.001;
        context.fillStyle = "rgba(0, 0, 0, 1)";
        context.fillRect(0, 0, c.width, c.height);
        context.save();
        context.translate(c.width / 2, c.height / 2);
        context.rotate(canvasAlpha);
        $.each(kreisen, function(index, kreise) {
            kreise.kreiseZeichen(context);
        });
        context.restore();
    }
}