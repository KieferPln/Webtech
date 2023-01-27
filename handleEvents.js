const MAPS_URL = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q=Space+Needle,Seattle+WA"
const MAPS_URL_BASE = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q="

const eventName = document.getElementById('event-name')
const eventDescription = document.getElementById('event-description')
const eventUrl = document.getElementById('event-url')
const eventTags = document.getElementById('event-tags')
const maps = document.getElementById('iframe-maps')

const fillEventPopup = (data, tags) => {
    eventName.appendChild(document.createTextNode(data.name ? data.name : 'Geen naam gevonden'))
    eventDescription.appendChild(document.createTextNode(data.description ? data.description : 'Geen beschrijving gevondeno'))
    eventUrl.setAttribute('href', data.url ? data.url : '')
    console.log(`${data.address.replace(/ /g,"+")},${data.city},${data.country}`)
    maps.setAttribute('src', MAPS_URL_BASE + `${data.address.replace(/ /g,"+")},${data.city},${data.country}`)

    for (let i = 0; i < tags.length; i++) { eventTags.appendChild(createTag(tags[i].subject)) }
}

const emptyEventPopup = () => {
    eventTags.innerHTML = ''
    eventName.innerHTML = ''
    eventDescription.innerHTML = ''
    eventUrl.innerHTML = ''
    maps.setAttribute('src',MAPS_URL)

}

const createTag = (name) => {
    const tag = document.createElement('div')
    tag.classList.add('tag')
    const nameNode = document.createTextNode(name)
    tag.appendChild(nameNode)
    return tag
}

const getTagsByEventId = async (id) => {
    const response = await fetch("fetch-tags.php");
    const data = await response.json();

    if (!data) return getTagsByEventId();
    return data.filter((tag) => tag.eventid == id);
}

const getEvents = async () => {
    const response = await fetch("fetch-events.php");
    const data = await response.json();

    if (!data) return getResult();
    return data;
}


