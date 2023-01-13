const getRectTopById = (id) => {
    return document.getElementById(id).offsetTop;
}

const scrollTo = (top) => {
    let main = document.getElementById('main')
    console.log(top)
    main.scrollTop = top
}

let navContent = document.getElementById('nav_content')
navContent.addEventListener('click', () => scrollTo(getRectTopById('content')), true);



