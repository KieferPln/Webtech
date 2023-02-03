
//Function to set the cookie with a name, value and expiration date.

setCookie = (cName, cValue, expDays) => {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path =/";
}

//Function to retrieve the value of a cookie.

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

// Event handler for hiding the cookie message and setting "cookie" and "visits" cookies

document.querySelector("#cookie-btn").addEventListener("click", () => {
    document.querySelector("#cookies").style.display = "none";
    setCookie("cookie", true, 30);
    if (!getCookie("visits")) {
        setCookie("visits", 1, 30);
    } else {
        let visits = parseInt(getCookie("visits")) + 1;
        setCookie("visits", visits, 30);
    }
});

//If the cookies are not accepted, the cookiemessage will appear.

cookieMessage = () => {
    if(!getCookie("cookie"))
        document.querySelector("#cookies").style.display = "block";
    else if(getCookie("cookie") === "true") {
        let visits = parseInt(getCookie("visits")) + 1;
        setCookie("visits", visits, 30);
    }
}

window.addEventListener("load", cookieMessage);

// COOKIES-BUBBLECOUNTER

 //Function to checks if the value of "cookie" is true. 

function acceptedCookies() {
    const cookieValue = getCookie("cookie");
    return cookieValue === "true";
}

  //checks if the cookies are accepted. If they are, the count value is added to the
  //bubblecount cookie.

function addCountToCookie(count) {
    if (acceptedCookies()) {
      var d = new Date();
      d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = "bubbleCount=" + count + ";" + expires + ";path=/";
    }
}

// grabs the count of the bubblecount cookie so it can be displayed on the main site

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


// Function to display the amount of bubbles the user has created.

  function displayBubbleCount() {
    const bubbleCount = getCountFromCookie();
    const bubbleCountDisplay = document.getElementById("bubble-count");
    if (!acceptedCookies()) {
      bubbleCountDisplay.innerHTML = "Accept the cookies to see how many bubbles you have created!";
    } else if (bubbleCount === 0) {
      bubbleCountDisplay.innerHTML = "You have not made any bubbles yet!";
    } else if (bubbleCount === 1) {
      bubbleCountDisplay.innerHTML = "You have made <b>1</b> bubble!";
    } else {
      bubbleCountDisplay.innerHTML = `You have made <b>${bubbleCount}</b> bubbles!`;
    }
  }
  
  // Call the function when the page is loaded
  displayBubbleCount();


    //when the user clicks on the decline button, the message will go away.

    document.querySelector("#decline-btn").addEventListener("click", () => {
        document.querySelector("#cookies").style.display = "none";
    });

    cookieMessage = () => {
        if(!getCookie("cookie"))
            document.querySelector("#cookies").style.display = "block";
        else if(getCookie("cookie") === "true") {
            let visits = parseInt(getCookie("visits")) + 1;
            setCookie("visits", visits, 30);
        }
        document.querySelector("#decline-btn").addEventListener("click", () => {
            document.querySelector("#cookies").style.display = "none";
            setCookie("cookie", false, 30);
        });
    }

    // 

    document.querySelector("#decline-btn").addEventListener("click", () => {
        document.querySelector("#cookies").style.display = "none";
        setCookie("bubbleCount", 0, 30);
    });

    /* sets the "bubbleCount" cookie value to an empty string and sets the expiration date to a time 
    in the past. This way the bubblecount cookie won't appear in the database when the user
    declines the cookies..*/

    document.querySelector("#decline-btn").addEventListener("click", () => {
        document.querySelector("#cookies").style.display = "none";
        document.cookie = "bubbleCount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      });