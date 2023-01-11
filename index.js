var active = false

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}

const createBubbles = async (e) => {
    let bubble_1 = document.getElementById('bubble-1');
    let bubble_2 = document.getElementById('bubble-2');
    let bubble_3 = document.getElementById('bubble-3');
    let bubble_4 = document.getElementById('bubble-4');
    let bubble_5 = document.getElementById('bubble-5');

    let left = e.offsetX;
    let top = e.offsetY;

    bubble_1.style.left = left + 'px';
    bubble_1.style.top = top + 'px';
    bubble_2.style.left = left + 'px';
    bubble_2.style.top = top + 'px';
    bubble_3.style.left = left + 'px';
    bubble_3.style.top = top + 'px';
    bubble_4.style.left = left + 'px';
    bubble_4.style.top = top + 'px';
    bubble_5.style.left = left + 'px';
    bubble_5.style.top = top + 'px';

    moveUp(bubble_1),
        moveUp(bubble_2),
        moveUp(bubble_3)
    moveUp(bubble_4)
    moveUp(bubble_5)
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

const moveUp = async (element) => {
    var scale = `scale(${getRandomArbitrary(0.35, .8)}`
    var xOffset = -50
    var swerve = Math.random() < 0.5

    const height = getRandomArbitrary(20, 60)
    const speed = getRandomArbitrary(15, 40)

    for (let i = 0; i < height; i++) {
        if (i > (height - 10)) { scale == 'scale(-2)' }
        if (swerve) { xOffset -= 1 }
        else { xOffset += 0 }
        element.style.transform = `translate(${xOffset + i * 2}%,${-i * 2}px) ${scale})`
        element.style.opacity = 1 - (i / height)
        await delay(speed)
    }

    element.style.opacity = 0
}


document.body.addEventListener('mousedown', createBubbles, true);

