const bubble_layer = document.getElementById('bubble-layer')
let main = document.getElementById('main')
var bubbleCount = 0

const delay = (time) => {
    return new Promise(resolve => setTimeout(resolve, time));
}

const getRandomArbitrary = (min, max) => {
    return Math.random() * (max - min) + min;
}

const generateSpeed = (amount) => {
    return [...Array(amount)].map(_ => getRandomArbitrary(15, 40))
}

const moveUp = async (element, speed) => {
    var size = `scale(${getRandomArbitrary(0.35, 1)}`
    var offset = -50
    const shouldSwerve = Math.random() < 0.5
    const height = getRandomArbitrary(15, 60)

    for (let i = 0; i < height; i++) {
        if (shouldSwerve) { offset -= 1 }
        else { offset += 0 }

        element.style.transform = `translate(${offset + i * 2}%,${-i * 2}px) ${size})`
        element.style.opacity = 1 - (i / height).toFixed(3)

        await delay(speed)
    }
    element.style.opacity = 0
}

const createElement = async (speed, position) => {
    const bubble = document.createElement("span");
    bubble.classList.add('bubble')
    bubble.style.left = position.x + 'px';
    bubble.style.top = position.y + 'px';
    header.appendChild(bubble);
    await moveUp(bubble, speed)
    header.removeChild(bubble)
}

const createBubbles = (e) => {
    bubbleCount++
    addCountToCookie(bubbleCount)
    const count = Math.round(getRandomArbitrary(3, 8))
    const speeds = generateSpeed(count)
    const position = { x: e.clientX, y: e.clientY + main.scrollTop }

    for (let i = 0; i < count; i++) {
        createElement(speeds[i], position)
    }
}

const addCountToCookie = (bubbleCount) => {
    
}

bubble_layer.addEventListener('mousedown', createBubbles, true);
