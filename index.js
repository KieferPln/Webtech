const getRectTopById = (id) => {
    return document.getElementById(id).getBoundingClientRect().top;
}

const scrollTo = (top) => {
    let main = document.getElementById('main')
    main.scrollTo(0, top)
}

let navContent = document.getElementById('nav_content')
navContent.addEventListener('click', () => scrollTo(getRectTopById('content')), true);




