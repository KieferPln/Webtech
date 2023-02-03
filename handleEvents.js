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

const fillEventPopup = (data, tags, audience) => {
    eventName.appendChild(document.createTextNode(data.name ? data.name : 'Geen naam gevonden'))
    eventDescription.appendChild(document.createTextNode(data.description ? data.description : 'Geen beschrijving gevonden'))
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

const emptyEventPopup = () => {
    eventTags.innerHTML = ''
    eventName.innerHTML = ''
    eventDescription.innerHTML = ''
    eventAudience.innerHTML = ''
    maps.setAttribute('src', MAPS_URL)
}

const createTag = (name) => {
    const tag = document.createElement('div')
    tag.classList.add('tag')
    const nameNode = document.createTextNode(name)
    tag.appendChild(nameNode)
    return tag
}

const getTagsByEventId = async (id) => {
    const response = await fetch("fetch-files/fetch-tags.php");
    const data = await response.json();
    if (!data) return getTagsByEventId();
    return data.filter((tag) => tag.eventid == id);
}

const getAudienceByEventId = async (id) => {
    const response = await fetch("fetch-files/fetch-audience.php");
    const data = await response.json();
    if (!data) return getAudienceByEventId();
    return data.filter((audience) => audience.eventid == id);
}

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

function filterEventsbySubjects(){
    let value = subjectSelect.value
    setCookie('filter_subjects',value,1)

    
        eventContainer.innerHTML = ''
        console.log('ok')
        appendEvents(); return
}

function filterEventsbyAudience(){
    let value = audienceSelect.value
    setCookie('filter_audience',value,1)

    
        eventContainer.innerHTML = ''
        console.log('ok')
        appendEvents(); return
}

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
