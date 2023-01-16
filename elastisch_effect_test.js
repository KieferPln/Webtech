//source: peeke.nl
const frequency = 2
const ease = t => t + (1 - t) * (1 - Math.cos(t * frequency * 2 * Math.PI))

const bounce = async (seconds) => {
    for (let t = 0; t <= seconds; t++) {
        console.log(ease(t))
        await delay(ease(t))
    }
}

bounce(500)