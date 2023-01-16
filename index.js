const getRectTopById = (id) => {
    console.log(document.getElementById(id).offsetTop)
    return document.getElementById(id).offsetTop;
}

const scrollTo = (top) => {
    let main = document.getElementById('main')
    main.scrollTop = top
}

let nav_events = document.getElementById('nav_events')
nav_events.addEventListener('click', () => scrollTo(getRectTopById('events')), true);

let nav_targets = document.getElementById('nav_targets')
nav_targets.addEventListener('click', () => scrollTo(getRectTopById('targets')), true);

let popup = document.getElementById('popup')
let blurdiv = document.getElementById('blur')
var popupIsTriggered = false

const togglePopup = () => {
    if (!popupIsTriggered) {
        popup.style.transform = "translateY(0%)"
        main.style.overflow = 'hidden'
    }
    else {
        popup.style.transform = "translateY(100%)"
        main.style.overflow = 'auto'
    }

    popupIsTriggered = !popupIsTriggered
}

