let popup = document.getElementById('popup')
let nav = document.getElementById('nav')
let infoPopup = document.getElementById('info-popup')
let blurdiv = document.getElementById('blur')
let addEventPopup = document.getElementById('add-event-popup')
let info = document.getElementById('info')

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

const insertInfoText = (type) => {
    const tileData = data[type]
    const h = document.createElement('h2')
    const c = document.createElement('p')
    var header = document.createTextNode(tileData.header);
    var content = document.createTextNode(tileData.content);
    h.appendChild(header)
    c.appendChild(content)
    info.appendChild(h)
    info.appendChild(c)
}

const removeInfoText = (type) => {
    if (info.hasChildNodes()) {
        info.removeChild(info.children[1])
        info.removeChild(info.children[1])
    }
}

const toggleInfoPopup = (type) => {
    if (popupIsTriggered) {
        popup.style.transform = "translateY(100%)"
    }

    if (!infoPopupIsTriggerd) {
        infoPopup.style.visibility = "visible"
        main.style.overflow = 'hidden'
        insertInfoText(type)
    }

    else {
        infoPopup.style.visibility = "hidden"
        main.style.overflow = 'auto'
        removeInfoText()

        if (popupIsTriggered) {
            popup.style.transform = "translateY(0%)"
            main.style.overflow = 'hidden'
        }
    }
    infoPopupIsTriggerd = !infoPopupIsTriggerd
}


const data = {
    'Pollution': { header: 'Pollution', content: 'This Is Pollution' },
    'Overfishing': { header: 'Overfishing', content: 'This Is Overfishing' },
    'Eutrophication': { header: 'Eutrophication', content: 'This Is Eutrophication' },
    'Acidification': { header: 'Acidification', content: 'This Is Acidification' },
    'Temperatures': { header: 'Temperatures', content: 'This Is Temperatures' }
}








