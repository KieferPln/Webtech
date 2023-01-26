const eventName = document.getElementById('event-name')
const eventDescription = document.getElementById('event-description')
const eventUrl = document.getElementById('event-url')


const fillEventPopup = (data) => {
    eventName.appendChild(document.createTextNode(data.name ? data.name : ''))
    eventDescription.appendChild(document.createTextNode(data.description ? data.description : ''))
    eventUrl.setAttribute('href', data.url ? data.url : '')
}

const emptyEventPopup = () => {
    eventName.innerHTML = ''
    eventDescription.innerHTML = ''
    eventUrl.setAttribute('href', '')
}

const getTagsByEventId = async (id) => {
    const response = await fetch("fetch-tags.php");
    const data = await response.json();
    if (!data) {
        return getTagsByEventId();
    } else {
        return data.filter((tag) => tag.eventid == id);
    }
}

const getEvents = async () => {
    const response = await fetch("fetch-events.php");
    const data = await response.json();
    if (!data) {
        return getResult();
    } else {
        return data;
    }
}


