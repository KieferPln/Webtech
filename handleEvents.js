const MAPS_URL = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q=Space+Needle,Seattle+WA"
const MAPS_URL_BASE = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q="

const eventName = document.getElementById('event-name')
const eventDescription = document.getElementById('event-description')
const eventUrl = document.getElementById('event-url')
const eventTags = document.getElementById('event-tags')
const eventAudience = document.getElementById('event-audience')
const maps = document.getElementById('iframe-maps')
const subjectSelect = document.getElementById('select-subject')
const audienceSelect = document.getElementById('select-audience')
let favorites_select = ''

// This function filss the event popup with all the data from the json files that is created in the fill-events
const fillEventPopup = (data, tags, audience) => {
    eventName.appendChild(document.createTextNode(data.name ? data.name : "We haven't found a name"))
    eventDescription.appendChild(document.createTextNode(data.description ? data.description : "We haven't found a description"))
    eventUrl.setAttribute('href', data.url ? data.url : '')
    console.log(`${data.address.replace(/ /g, "+")},${data.city},${data.country}`)
    console.log('vanuit index.js', audience)
    maps.setAttribute('src', MAPS_URL_BASE + `${data.address.replace(/ /g, "+")},${data.city},${data.country}`)
    for (let i = 0; i < tags.length; i++) { eventTags.appendChild(createTag(tags[i].subject)) }

    if (audience) {
        for (let i = 0; i < audience.length; i++) {
            audience_container = document.createElement('div')
            audience_container.classList.add('audience')
            audience_container.appendChild(document.createTextNode(audience[i].target_audience ? audience[i].target_audience : ''))
            eventAudience.appendChild(audience_container)
        }
    }
}

// This clears everything from the event popup so next time an event is opened the last event has been deleted
const emptyEventPopup = () => {
    eventTags.innerHTML = ''
    eventName.innerHTML = ''
    eventDescription.innerHTML = ''
    eventAudience.innerHTML = ''
    maps.setAttribute('src', MAPS_URL)
}

// this creates the tags of the events using textnodes
const createTag = (name) => {
    const tag = document.createElement('div')
    tag.classList.add('tag')
    const nameNode = document.createTextNode(name)
    tag.appendChild(nameNode)
    return tag
}

// Here we call the fetch tags file and look for the tags inside the json it creates
const getTagsByEventId = async (id) => {
    const response = await fetch("fetch-files/fetch-tags.php");
    const data = await response.json();
    if (!data) return getTagsByEventId();
    return data.filter((tag) => tag.eventid == id);
}

// Here we call the fetch audience file and loog fot the target audience inside the json it creates
const getAudienceByEventId = async (id) => {
    const response = await fetch("fetch-files/fetch-audience.php");
    const data = await response.json();
    if (!data) return getAudienceByEventId();
    return data.filter((audience) => audience.eventid == id);
}

// this is were the events are called, multiple if and else if statements are used. This is needed
// because it needs to work correctlu with the different filters
const getEvents = async () => {
    var response;

    if(getCookie('filter_subjects') && getCookie('filter_audience') && getCookie('favorites_select')) 
    {
        response = await fetch("fetch-files/fetch-favorites-events-multiple.php");
    }
    else if(getCookie('filter_subjects') && getCookie('filter_audience')) 
    {
        response = await fetch("fetch-files/fetch-filters-multiple.php");
    }
    else if(getCookie('filter_subjects') && getCookie('favorites_select')) 
    {
        response = await fetch("fetch-files/fetch-favorites-events-subjects.php");
    }
    else if(getCookie('filter_audience') && getCookie('favorites_select')) 
    {
        response = await fetch("fetch-files/fetch-favorites-events-audience.php");
    }
    else if(getCookie('filter_subjects'))
    {
        response = await fetch("fetch-files/fetch-filters-subjects.php");
    }
    else if(getCookie('favorites_select'))
    {
        response = await fetch("fetch-files/fetch-favorites-events.php");
    }
    else if(getCookie('filter_audience'))
    {
        response = await fetch("fetch-files/fetch-filters-audience.php");
    }
    else(response = await fetch("fetch-files/fetch-events.php"))

    const data = await response.json();
    console.log(data)
    if (!data) return getResult();
    return data;
}

// this gets the values from the dropdown menu of the subject filter. It than makes a cookie which
// stores the value
function filterEventsbySubjects(){
    let value = subjectSelect.value
    setCookie('filter_subjects',value,1)

    
        eventContainer.innerHTML = ''
        console.log('ok')
        appendEvents(); return
}

// this gets the values from the dropdown menu of the audience filter. It than makes a cookie which
// stores the value
function filterEventsbyAudience(){
    let value = audienceSelect.value
    setCookie('filter_audience',value,1)

    
        eventContainer.innerHTML = ''
        console.log('ok')
        appendEvents(); return
}

// this checks if the show favorites button is pressed and puts that in an cookie. '' is used as the
// false boolean.
function showFavorites(){
    if (favorites_select === ''){
        favorites_select = true
    }
    else{
        favorites_select = ''
    }
        setCookie('favorites_select',favorites_select,1)

    eventContainer.innerHTML = ''
    console.log('ok')
    appendEvents(); return
}
