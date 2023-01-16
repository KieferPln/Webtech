//source: peeke.nl
const frequency = 2
const ease = t => t + (1 - t) * (1 - Math.cos(t * frequency * 2 * Math.PI))

var c = document.getElementById("canvas"); // Grab canvas object
var ctx = c.getContext("2d"); // Define canvas context
var w = c.width; // Canvas width => Frequency is relative to this
var h = c.height / 2; // Canvas height over two => Amplitude: Volume
var f = 1; // How many cycles per canvas width => Frequency: Tone & Speed
// Calculates y position from x
function calcSineY(x) {
    // This is the meat (unles you are vegan)
    // Note that:
    // h is the amplitude of the wave
    // x is the current x value we get every time interval
    // 2 * PI is the length of one cycle (full circumference)
    // f/w is the frequency fraction
    return h - h * Math.sin(x * 2 * Math.PI * (f / w));
}
function drawSine(x) {
    ctx.clearRect(0, 0, w, h * 2);
    //draw x axis
    ctx.beginPath(); // Draw a new path
    ctx.strokeStyle = "green"; // Pick a color
    ctx.moveTo(0, h); // Where to start drawing
    ctx.lineTo(w, h); // Where to draw to
    ctx.stroke(); // Draw

    // draw horizontal line of current amplitude
    ctx.beginPath(); // Draw a new path
    ctx.moveTo(0, h); // Where to start drawing
    ctx.strokeStyle = "gray"; // Pick a color
    for (var i = 0; i < x; i++) { // Loop from left side to current x
        var y = calcSineY(x); // Calculate y value from x
        ctx.moveTo(i, y); // Where to start drawing
        ctx.lineTo(x, y); // Where to draw to
    }
    ctx.stroke(); // Draw

    // draw amplitude bar at current point
    ctx.beginPath(); // Draw a new path
    ctx.strokeStyle = "red"; // Pick a color
    for (var i = 0; i < x; i++) { // Loop from left side to current x
        var y = calcSineY(x); // Calculate y value from x
        ctx.moveTo(x, h); // Where to start drawing
        ctx.lineTo(x, y); // Where to draw to
    }
    ctx.stroke(); // Draw

    // draw area below y
    ctx.beginPath(); // Draw a new path
    ctx.strokeStyle = "orange"; // Pick a color
    for (var i = 0; i < x; i++) { // Loop from left side to current x
        if (i / 3 == Math.round(i / 3)) { // Draw only one line each 3 pixels
            var y = calcSineY(i); // Calculate y value from x
            ctx.moveTo(i, h); // Where to start drawing
            ctx.lineTo(i, y); // Where to draw to
        }
    }
    ctx.stroke(); // Draw

    // draw sin curve point to point until x
    ctx.beginPath(); // Draw a new path
    ctx.strokeStyle = "black"; // Pick a color
    for (var i = 0; i < x; i++) { // Loop from left side to current x
        var y = calcSineY(i); // Calculate y value from x
        ctx.lineTo(i, y); // Where to draw to
    }
    ctx.stroke(); // Draw
}
// Define initial value of x positiom (leftmost side of cnanvas)
var x = 0;
// Start time interval

const repeat = 1
var interval = setInterval(function () {
    drawSine(x); // Call draww function every cycle
    x++; // Increment x by 1
    if (x > w) {
        x = 0; // x cannot be more than canvas with, so back to 0
        f++; // increment frequency for demonstration
    }
}, 10); // Loop every 10 milliseconds
