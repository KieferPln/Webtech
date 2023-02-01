var currentEvent = 0
let popup = document.getElementById('popup')
let nav = document.getElementById('nav')
let infoPopup = document.getElementById('info-popup')
let blurdiv = document.getElementById('blur')
let addEventPopup = document.getElementById('add-event-popup')
let info = document.getElementById('info')
var bubbleCount = 0

const getRectTopById = (id) => {
    return document.getElementById(id).offsetTop - nav.clientHeight;
}

const scrollTo = (top) => {
    main.scrollTop = top
}

let nav_events = document.getElementById('nav_events')
nav_events.addEventListener('click', () => scrollTo(getRectTopById('events')), true);

let nav_information = document.getElementById('nav_information')
nav_information.addEventListener('click', () => scrollTo(getRectTopById('information')), true);;

let nav_about_us = document.getElementById('nav_about_us')
nav_about_us.addEventListener('click', () => scrollTo(getRectTopById('about_us')), true);;

var popupIsTriggered = false
var infoPopupIsTriggerd = false
var addEventPopupIsTriggerd = false

const toggleAddEventPopup = (eventid = undefined) => {
    if (!addEventPopupIsTriggerd) {
        if (eventid) {
            // Make an AJAX call to retrieve the data of the event with the given id
            fetch(`retrieve_event.php?eventid=${eventid}`)
            .then(response => {
                console.log("response: ", response);
                return response.json();
            })
            .then(data => {
                console.log("data: ", data)
                return data;
            })
            .catch(error => console.error('Error:', error))
            .then(data => {
            // Populate the form fields with the retrieved data
            console.log(data);
            document.getElementById('edit-id').value = data.eventid;
            document.getElementById('name').value = data.name;
            document.getElementById('date').value = data.date;
            document.getElementById('description').value = data.description;
            document.getElementById('url').value = data.url;
            document.getElementById('country').value = data.country;
            document.getElementById('city').value = data.city;
            document.getElementById('address').value = data.address;
            document.getElementById("submit-edit").style.visibility = "visible";            

            // subjects checkboxes
            var subjects = document.querySelectorAll(".subjects-container input[type='checkbox']");
            for (var i = 0; i < subjects.length; i++) {
            if (data.subjects.includes(subjects[i].value)) {
            subjects[i].checked = true;
            }
            }

            // audience checkboxes
            var audience = document.querySelectorAll(".subjects-container input[type='checkbox']");
            for (var i = 0; i < audience.length; i++) {
            if (data.audience.includes(audience[i].value)) {
            audience[i].checked = true;
            }
            }
            })
            .catch(error => console.error('Error:', error));

        } else {
            document.getElementById('name').value = '';
            document.getElementById('date').value = '';
            document.getElementById('description').value = '';
            document.getElementById('url').value = '';
            document.getElementById('country').value = '';
            document.getElementById('city').value = '';
            document.getElementById('address').value = '';
            document.getElementById("submit-edit").style.visibility = "hidden";            
            const checkboxes = document.querySelectorAll("input[type='checkbox']");
            for (let checkbox of checkboxes) {
                checkbox.checked = false;
            }
        }
    addEventPopup.style.visibility = "visible"
    main.style.overflow = 'hidden'
    }
    else {
        addEventPopup.style.visibility = "hidden";
        document.getElementById("submit-edit").style.visibility = "hidden";
        main.style.overflow = 'auto';
    }
    addEventPopupIsTriggerd = !addEventPopupIsTriggerd
    var eventid = null;
};


const togglePopup = () => {
    if (!popupIsTriggered) {
        popup.style.transform = "translateY(0%)"
        main.style.overflow = 'hidden'

        getEvents().then(events => {
            const event = events.find((event) => event.eventid == currentEvent)
            getTagsByEventId(event.eventid).then(tags => {        
                fillEventPopup(event,tags)
            }).catch(err => console.log(err))
        }).catch(err => console.log(err))

    }
    else {
        popup.style.transform = "translateY(100%)"
        main.style.overflow = 'auto'
        emptyEventPopup()
    }""
    popupIsTriggered = !popupIsTriggered
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

const data = {
    'Pollution': {
        header: 'Pollution', content:
            "Due to an increase in plastic consumption and ineffective waste management strategies, more \
    plastic than ever is ending up in the ocean. Of all the waste that finds its way to the ocean, 85% \
    is plastic. In 2021, more than 17 million metric tons of plastic entered the ocean. Instead of \
    becoming less, this number is projected to double or triple by 2040. \
    Plastic in oceans form a great danger to marine life. Sea animals often mistake plastic for prey. \
    After eating the plastic they die from starvation as their stomachs become full with plastic. \
    Another danger for sea life is getting ensnared in the plastic waste, resulting in injury or death. \
    Besides these immediate dangers from plastic waste, large plastics eventually become microplastics. \
    The complete dangers of microplastics are still unknown, but it is clear that they find their way \
    into our food and water supplies, and eventually into our bodies." },

    'Overfishing': {
        header: 'Overfishing', content:
            "Overfishing has the obvious consequence of reducing population levels of marine life, thereby \
    threatening overfished species with extinction. This threatens food supplies and entire marine \
    ecosystems. Another consequence is that overfishing impacts the ability the ocean has to store \
    carbon, which is a crucial part of climate change mitigation (as mentioned in the 'rising \
    temperatures' section)."},

    'Eutrophication': {
        header: 'Eutrophication', content:
            "Eutrophication occurs when nutrients are added to the environment. This is predominantly caused by \
    washout of agricultural fertilizers which are rich in phosphorus and nitrogen. Other possible causes \
    are sewage disposal and the intentional adding of nutrients to attract economically or \
    recreationally important marine species. These added nutrients cause an increase in algae and plant \
    growth in costal regions and estuaries (where fresh and salt water meet). When these \
    algae die, oxygen in the water is used to decompose the dead algae. Lack of oxygen leads to the \
    death of marine life and can cause so-called dead zones, places where the water contains little to \
    no life. \n \
    n\ \
    An example of a dead zone is along the Gulf Coast of the United States. In 2021, this area \
    was 16.405 square kilometers. Another example is along the coast of Chili, where in 2016 23 million \
    dead salmon washed ashore. This was attributed to algae blooms, caused by eutrophication." },

    'Acidification': {
        header: 'Acidification', content:
            "A quarter of annual carbon emissions are absorbed by the ocean. This reduces the immediate impact of \
    climate change. However, it also causes the ocean to increase in acidity. This poses a danger to \
    marine ecosystems, fisheries, and coastal protection due to reduction of coral reefs. It is \
    projected that acidification will increase in coming years. This is not only problematic due to the \
    aforementioned reasons, it also reduces the ocean's ability to absord carbon emissions in the \
    future, thereby worsening climate change." },

    'Temperatures': {
        header: 'Temperatures', content:
            'Ocean temperatures are rising because they absorb the largest part of the excess energy and heat \
    from greenhouse gas emissions. It is estimated that oceans have absorbed approxiamately 90% of \
    warmth created by increased emissions. This comes with several risks. First of all, rising ocean \
    temperature causes polar ice to melt, which in turn causes sea-levels to rise. Rising ocean levels \
    are a risk to coastal areas. This is caused by the increased chance of extreme events such as \
    coastal flooding, landslides and erosion. Not only the 2 billion people living in coastal areas are \
    at risk. All life in coastal areas is under threat from rising sea levels. Second, the UN has \
    estimated that 60% of marine ecosystems are currently being used in an \
    unsustainable way or are otherwise degrading. Even worse, they estimate that half of marine species \
    may be facing extinction by 2100.\n \
    \n \
    A prime example of rising temperatures causing damage to marine \
    ecosystems is the bleaching and eventual destruction of coral reefs. Currently, we stand at a \
    temperature increase of 1.1°C. An increased temperature of 1.5°C would cause the destruction of 70 \
    to 90% of coral reefs. An even higher increase of 2°C would cause the disappearance of 99% of coral \
    reefs. At this point, there would be no way of reestablishing coral ecosystems. A third danger is \
    the increase of probability of marine heatwaves. These heatwaves compound the regular dangers of \
    rising ocean temperatures. ' },

    'Sources': {
        header: 'Sources', content:
            'Content still needs to be added.'
    },

    'privacy': {
        header: 'Privacy Statement', content:
    "Our website uses cookies to enhance your browsing experience and gather information about how our site is used.\
    By continuing to use our site, you consent to our use of cookies in accordance with our privacy statement: \
    We use cookies to personalize content, to provide features and to analyze our traffic. \
    You can control the use of cookies at the individual browser level, but if you choose to disable cookies, \
    it may limit your use of certain features or functions on our website. \
    Our privacy policy is subject to change and updates without notice. \
    You can access our privacy policy at any time by visiting our website."},

}


const changeMapsLocation = (location) => {

}

const eventContainer = document.getElementById('event-container')
const favoriteButton = document.getElementById('favorite-button')

// dit is alleen om overzichtelijk bij Upcoming Events te laten zien dat het toevoegen en verwijderen
// van events bij favorieten werkt. kan er in principe uit voor we inleveren maar kan misschien 
// ergens anders voor worden gebruikt.
$.ajax({
    url: "fetch-favorites.php",
    type: "GET",
    dataType: "json",
    success: function(favorite_events) {
        var eventids = favorite_events.map(function(event) {
            return event.eventid;
        });
        $("#upcoming").append(" " + eventids.join(", "));
    }
}); 

const toggleFavorite = (eventid, button) => {
    // AJAX call to remove the event if it is a favorite or add if it isn't
    $.ajax({
        url: "toggle-favorite.php",
        type: "POST",
        data: { eventid: eventid },
        success: function(response) {
            console.log(response);
            const img = button.querySelector('img');
            // switch the image to reflect the updated favorite-status
            if (img.src.endsWith('cross.svg')) {
                img.src = 'check.svg';
            } else if (img.src.endsWith('check.svg')) {
                img.src = 'cross.svg';
            }
        }
    });
}


const createEvent = (name, date, id) => {
    
    const container = document.createElement('div')
    const circle = document.createElement('span')
    const eventName = document.createElement('div')
    const eventDate = document.createElement('div')
    const titleNode = document.createTextNode(name)
    const dateNode = document.createTextNode(date)
    const eventid = document.createElement('button')
    

    eventid.innerHTML = id
    container.classList.add('event')
    eventDate.classList.add('date')
    circle.classList.add('circle')
    eventName.classList.add('name')
    eventName.appendChild(titleNode)
    eventDate.appendChild(dateNode)
    container.appendChild(circle)
    container.appendChild(eventName)
    container.appendChild(eventDate)
    container.appendChild(eventid)
    
    container.addEventListener('click', () => { togglePopup(), currentEvent = id }, true);
    
    return container
}

const appendEvents = () => {
    // check if the user is logged in
    $.ajax({
        url: "check-login.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // if they are logged in, get the user's favorites
            if (response.loggedIn) {
                $.ajax({
                    url: "fetch-favorites.php",
                    type: "GET",
                    dataType: "json",
                    success: function(favorite_events) {
                        var eventids = favorite_events.map(function(event) {
                            return event.eventid;
                        });
    
                        getEvents().then(events => {
                            for (let i = 0; i < events.length; i++) {
                                // only show the favorite button if the user is logged in
                                const favorite_button = document.createElement('button');
                                favorite_button.type="button";
                                const favorite_img = document.createElement('img');
                                //set the initial favorite_img depending on database info
                                if (eventids.includes(events[i].eventid)) {
                                    favorite_img.src = 'check.svg';
                                } else {
                                    favorite_img.src = 'cross.svg';
                                }
                                const edit_button = document.createElement('button');
                                edit_button.type="button";
                                const edit_img = document.createElement('img');
                                edit_img.src = 'edit.png';
                                // only show the edit_button if the logged in user is the admin
                                if (response.isAdmin) {
                                    edit_button.appendChild(edit_img);
                                    eventContainer.appendChild(edit_button);
                                }
                                favorite_button.appendChild(favorite_img);
                                favorite_button.addEventListener('click', () => toggleFavorite(events[i].eventid, favorite_button));                    
                                favorite_button.classList.add("favorite-button");
                                eventContainer.appendChild(favorite_button);
                                edit_button.classList.add("edit-button");
                                edit_button.addEventListener('click', () => toggleAddEventPopup(events[i].eventid));
                                eventContainer.appendChild(createEvent(events[i].name, events[i].date, events[i].eventid));
                            }
                        }).catch(err => console.log(err))
                    }
                });
            // if they aren't logged in, only show the events without favorite/edit button
            } else {
                getEvents().then(events => {
                    for (let i = 0; i < events.length; i++) {
                        eventContainer.appendChild(createEvent(events[i].name, events[i].date, events[i].eventid));
                    }
                }).catch(err => console.log(err))
            }
        }
    });
}

appendEvents();

