let popup = document.getElementById('popup')
let nav = document.getElementById('nav')
let infoPopup = document.getElementById('info-popup')
let blurdiv = document.getElementById('blur')
let addEventPopup = document.getElementById('add-event-popup')

const getRectTopById = (id) => {
    console.log(document.getElementById(id).offsetTop)
    return document.getElementById(id).offsetTop - nav.clientHeight;
}

const scrollTo = (top) => {
    main.scrollTop = top
}

let nav_events = document.getElementById('nav_events')
nav_events.addEventListener('click', () => scrollTo(getRectTopById('events')), true);

let nav_information = document.getElementById('nav_information')
nav_information.addEventListener('click', () => scrollTo(getRectTopById('information')), true);

// let nav_targets = document.getElementById('nav_targets')
// nav_targets.addEventListener('click', () => scrollTo(getRectTopById('targets')), true);

var popupIsTriggered = false
var infoPopupIsTriggerd = false
var addEventPopupIsTriggerd = false

const toggleAddEventPopup = () => {
    if (!addEventPopupIsTriggerd) {
        addEventPopup.style.visibility = "visible"
        main.style.overflow = 'hidden'
    }
    else {
        addEventPopup.style.visibility = "hidden"
        main.style.overflow = 'auto'
    }
    addEventPopupIsTriggerd = !addEventPopupIsTriggerd
}

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

const setInfo = (type) => {
    switch (type) {
        case 'Tile1':
            return 'ok'

        case 'Tile2':
            return 'ok'

        default:
            break;
    }
}

const toggleInfoPopup = (type) => {
    if (popupIsTriggered) {
        popup.style.transform = "translateY(100%)"
    }

    if (!infoPopupIsTriggerd) {
        infoPopup.style.visibility = "visible"
        main.style.overflow = 'hidden'

        const bubble = document.createElement("h1");
        infoPopup.appendChild(bubble)
    }

    else {
        infoPopup.style.visibility = "hidden"
        main.style.overflow = 'auto'

        if (popupIsTriggered) {
            popup.style.transform = "translateY(0%)"
            main.style.overflow = 'hidden'
        }
    }

    infoPopupIsTriggerd = !infoPopupIsTriggerd
    console.log(type)
}