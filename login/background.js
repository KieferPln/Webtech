const canvas = document.getElementById('canvas')
const ctx = canvas.getContext('2d')

canvas.width = window.innerWidth
canvas.height = window.innerHeight
const COLORS = ['red', 'blue', 'green', 'purple']
let mouse = {
    x: null, y: null,
    radius: (canvas.height / 80) * (canvas.width / 80)
}
let particlesArray;

window.addEventListener('mousemove', (e) => { mouse.x = e.x; mouse.y = e.y })

class Particle {
    constructor(x, y, directionX, directionY, size, color) {
        this.x = x
        this.y = y
        this.directionX = directionX
        this.directionY = directionY
        this.size = size
        this.color = color
    }
    draw() {


        ctx.beginPath();
ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
ctx.strokeStyle = "#FFFFFF";
ctx.globalAlpha = 0.5
ctx.stroke();
    }
    update() {

        if (this.x > canvas.width || this.x < 0) {
            this.directionX = -this.directionX
        }
        if (this.y > canvas.height || this.y < 0) {
            this.directionY = -this.directionY
        }
        // check collision
        let dx = mouse.x - this.x
        let dy = mouse.y - this.y
        let distance = Math.sqrt(dx ** 2 + dy ** 2)
        let speed = 2

        if (distance < mouse.radius + this.size) {
            if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                this.directionX = -this.directionX
                this.x += speed
            }
            if (mouse.x > this.x && this.x > this.size * 10) {
                this.directionX = -this.directionX
                this.x -= speed
            }
            if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                this.directionY = -this.directionY
                this.y += speed
            }
            if (mouse.y > this.y && this.y > this.size * 10) {
                this.directionY = -this.directionY
                this.y -= speed
            }
        }
        this.x += this.directionX / 5;
        this.y += this.directionY / 5;
        this.draw()
    }
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
function init() {
    particlesArray = []
    let numberOfParticles = 50;
    for (let i = 0; i < numberOfParticles; i++) {
        let size = getRandomArbitrary(2,7)
        let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2)
        let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2)
        let directionX = (Math.random() * 5) - 2.5
        let directionY = (Math.random() * 5) - 2.5
        let color = "#FFFFFF"

        particlesArray.push(new Particle(x, y, directionX, directionY, size, color))
    }
}

function getDistance(x1, y1, x2, y2) {
    let y = x2 - x1;
    let x = y2 - y1;

    return Math.sqrt(x * x + y * y);
}

function debounce(func) {
    var timer;
    return function (event) {
        if (timer) clearTimeout(timer);
        timer = setTimeout(func, 100, event);
    };
}

function animate() {
    requestAnimationFrame(animate)
    ctx.clearRect(0, 0, innerWidth, innerHeight);

    for (let i = 0; i < particlesArray.length; i++) {
        particlesArray[i].update()
    }
}

// resize event
window.addEventListener('resize', debounce(() => {
    canvas.width = innerWidth
    canvas.height = innerHeight
    mouse.radius = ((canvas.height / 80) * (canvas.height / 80))
    init()
}))
window.addEventListener('mouseout', debounce(() => {
    mouse.x = undefined
    mouse.y = undefined
}))

init()
animate()
