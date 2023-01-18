let popup = document.getElementById('popup')
let nav = document.getElementById('nav')
let infoPopup = document.getElementById('info-popup')
let blurdiv = document.getElementById('blur')

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

}

const toggleInfoPopup = (type) => {

    if (popupIsTriggered) {
        popup.style.transform = "translateY(100%)"
    }
    if (!infoPopupIsTriggerd) {
        infoPopup.style.opacity = "1"
        infoPopup.style.visibility = "visible"
        main.style.overflow = 'hidden'
    }
    else {

        infoPopup.style.opacity = "0"
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