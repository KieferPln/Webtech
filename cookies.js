// setCookie = (cName, cValue, expDays) => {
//     let date = new Date();
//     date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
//     const expires = "expires=" + date.toUTCString();
//     document.cookie = cName + "=" + cValue + "; " + expires + "; path =/";
// }

// getCookie = (cName) => {
//     const name = cName + "=";
//     const cDecoded = decodeURIComponent(document.cookie); 
//     const cArr = cDecoded.split("; ");
//     let value;
//     cArr.forEach(val => {
//         if(val.indexOf(name) === 0)value = val.substring(name.length);
//     })

//     return value;
// }




// // Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Function to get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Function to check if a cookie exists
function cookieExists(name) {
    return (getCookie(name) !== null);
}

// Check if the "visits" cookie exists
if (!cookieExists("visits")) {
    // If the "visits" cookie does not exist, set it to 1
    setCookie("visits", 1, 30);
} else {
    // If the "visits" cookie exists, increment the value by 1
    var visits = parseInt(getCookie("visits")) + 1;
    setCookie("visits", visits, 30);
}

cookieMessage = () => {
    if(!getCookie("cookie"))
        document.querySelector("#cookies").style.display = "block";
}

document.querySelector("#cookie-btn").addEventListener("click", () => {
    document.querySelector("#cookies").style.display = "none";
    setCookie("cookie", visits, 30);
})

window.addEventListener("load", cookieMessage);

