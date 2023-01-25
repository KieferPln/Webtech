setCookie = (cName, cValue, expDays) => {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path =/";
}

getCookie = (cName) => {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); 
    const cArr = cDecoded.split("; ");
    let value;
    cArr.forEach(val => {
        if(val.indexOf(name) === 0)value = val.substring(name.length);
    })

    return value;
}

document.querySelector("#cookie-btn").addEventListener("click", () => {
    document.querySelector("#cookies").style.display = "none";
    setCookie("cookie", true, 30);
    if (!getCookie("visits")) {
        setCookie("visits", 1, 365);
    } else {
        let visits = parseInt(getCookie("visits")) + 1;
        setCookie("visits", visits, 365);
    }
});

cookieMessage = () => {
    if(!getCookie("cookie"))
        document.querySelector("#cookies").style.display = "block";
    else if(getCookie("cookie") === "true") {
        let visits = parseInt(getCookie("visits")) + 1;
        setCookie("visits", visits, 365);
    }
}

window.addEventListener("load", cookieMessage);

// COOKIES-BUBBLECOUNTER

function addCountToCookie(count) {
    var d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = "bubbleCount=" + count + ";" + expires + ";path=/";
}

function getCountFromCookie() {
    var name = "bubbleCount=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}