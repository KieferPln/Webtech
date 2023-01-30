// Get the element with id "bubble-layer" and assign it to the variable "bubble_layer"
const bubble_layer = document.getElementById('bubble-layer')
// Get the element with id "main" and assign it to the variable "main"
let main = document.getElementById('main')
// Get the bubble count from a cookie and assign it to the variable "bubbleCount"
var bubbleCount = getCountFromCookie()

// Delay a Promise by a specified time
const delay = (time) => {
    return new Promise(resolve => setTimeout(resolve, time));
}

// Generate a random number between min and max
const getRandomArbitrary = (min, max) => {
    return Math.random() * (max - min) + min;
}

// Function to generate an array of speeds for a specified number of elements
const generateSpeed = (amount) => {
    return [...Array(amount)].map(_ => getRandomArbitrary(15, 40))
}

// Function to move an element upward with a specified speed
const moveUp = async (element, speed) => {
    // Calculate a random size for the element
    var size = `scale(${getRandomArbitrary(0.35, 1)}`
    // Initialize the offset with a negative value
    var offset = -50
    // Generate a random number to determine if the element should swerve or not
    const shouldSwerve = Math.random() < 0.5
    // Calculate a random height for the element
    const height = getRandomArbitrary(15, 60)

    // Loop to move the element upward
    for (let i = 0; i < height; i++) {
        // Check if the element should swerve
        if (shouldSwerve) { offset -= 1 }
        else { offset += 0 }

        // Update the transform and opacity style of the element
        element.style.transform = `translate(${offset + i * 2}%,${-i * 2}px) ${size})`
        element.style.opacity = 1 - (i / height).toFixed(3)

        // Wait for the specified time before continuing the loop
        await delay(speed)
    }
    // Set the opacity of the element to 0 after it has moved upward
    element.style.opacity = 0
}

// Function to create a new element with a specified speed and position
const createElement = async (speed, position) => {
    // Create a new span element and add the class "bubble"
    const bubble = document.createElement("span");
    bubble.classList.add('bubble')
    // Set the position of the element using the specified x and y coordinates
    bubble.style.left = position.x + 'px';
    bubble.style.top = position.y + 'px';
    // Append the element to the header
    header.appendChild(bubble);
    // Move the element upward with the specified speed
    await moveUp(bubble, speed)
    // Remove the element from the header after it has moved upward
    header.removeChild(bubble)
}

// function to create bubbles on mouse down event
const createBubbles = (e) => {
    // get the current count of bubbles from cookie
    let bubbleCount = getCountFromCookie();
    // if no value found, set it to 0
    if(bubbleCount === "") {
        bubbleCount = 0;
    } else {
        // convert the string value to int
        bubbleCount = parseInt(bubbleCount);
    }
    // increment the count
    bubbleCount++
    // add the updated count to the cookie
    addCountToCookie(bubbleCount)
    // call the function to display the bubble count
    displayBubbleCount();
    // calculate the number of bubbles to create
    const count = Math.round(getRandomArbitrary(3, 8))
    // get the speeds for each bubble
    const speeds = generateSpeed(count)
    // get the mouse click position
    const position = { x: e.clientX, y: e.clientY + main.scrollTop }
    // loop over the count and create bubbles with corresponding speed
    for (let i = 0; i < count; i++) {
        createElement(speeds[i], position)
        }
    }

// add event listener to the bubble layer to trigger createBubbles function on mousedown
bubble_layer.addEventListener('mousedown', createBubbles, true);
