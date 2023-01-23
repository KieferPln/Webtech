<?php
/*
	require ('../connection.php');
	session_start();
 
	if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
?>

<?php
				$id = $_SESSION['user'];
				$sql = $conn->prepare("SELECT * FROM `users` WHERE `id`='$id'");
				$sql->execute();
				$fetch = $sql->fetch();
                */
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Life Below Water</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <div class="main" id="main">
        <div class="header" id="header" style="padding: var(--gutter-l);">
            <p style="position: absolute; font-size: .6em; opacity: .5; top: var(--gutter-l);">Click anywhere to create
                bubbles!</p>
            <div class="login-container">
                <button class="login" onclick="window.location.href='./login';">
                    <i class="gg-user"></i> Log In
                </button>
                <div class="sign-up-button">
                    <a href="./login/registration.php">Or Sign Up</a>
                </div>
            </div>
            <div style="width:fit-content; height: fit-content; display:flex; flex-direction: column;">
                <h1>Life Below Water</h1>
                <h2 style="width: 80%">Conserve and sustainably use the oceans, seas and marine resources for
                    sustainable development.</h2>
            </div>
            <div id="bubble-layer"></div>
        </div>
        <div id='nav' class="nav-placeholder">
            <ul class="nav-container">
                <li id='nav_information'>Information</li>
                <li id="nav_events">Events</li>
                <li id='nav_about_us'>About Us</li>
                <li id="nav_add_event" onclick="toggleAddEventPopup()">Add Event *</li>
            </ul>
        </div>

        <!-- *********** COOKIE *********** -->
        <div id="cookies">
            <div class="cookie-container">
                <div class="cookie-subcontainer">
                    <div class="cookies">
                        <p>This website uses cookies to ensure you get the best experience on our website.
                            <a href=" ">More info.</a>
                        </p>
                        <button id="cookie-btn">Accept</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="cookies.js"></script>
        <div id="content">

            <!-- *********** INFORMATION *********** -->
            <div id="information">
                <h2 style="margin-top: var(--gutter-m);">Information</h2>
                <div class="tile-container">
                    <div onclick="toggleInfoPopup('Pollution')" class="tile">
                        <div class="tile-content-container">
                            (Plastic) pollution
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Overfishing')" class="tile">
                        <div class="tile-content-container">
                            Overfishing
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Eutrophication')" class="tile">
                        <div class="tile-content-container">
                            Eutrophication
                        </div>
                    </div>
                </div>
                <div class="tile-container">
                    <div onclick="toggleInfoPopup('Acidification')" class="tile">
                        <div class="tile-content-container">
                            Acidification
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Temperatures')" class="tile">
                        <div class="tile-content-container">
                            Rising temperatures
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Sources')" class="tile">
                        <div class="tile-content-container">
                            Sources & research
                        </div>
                    </div>
                </div>
            </div>

            <!-- *********** EVENTS *********** -->
            <div id="events">
                <h2 style="margin-top: var(--gutter-m)">Upcoming Events</h2>
                <div class=" event-container">
                    <div class="event" onclick="togglePopup()">
                        <span class=" circle"></span>
                        <div class="name">
                            Ms. Jones
                        </div>
                        <div class="date">
                            16-05-22
                        </div>
                    </div>
                </div>
                <div class="event-container">
                    <div class="event" onclick="togglePopup()">
                        <span class=" circle"></span>
                        <div class="name">
                            Ms. Jones
                        </div>
                        <div class="date">
                            16-05-22
                        </div>
                    </div>
                </div>
                <div class="event-container">
                    <div class="event" onclick="togglePopup()">
                        <span class=" circle"></span>
                        <div class="name">
                            Ms. Jones
                        </div>
                        <div class="date">
                            16-05-22
                        </div>
                    </div>
                </div>
                <div class="event-container">
                    <div class="event" onclick="toggleEventPopup()">
                        <span class=" circle"></span>
                        <div class="name">
                            Ms. Jones
                        </div>
                        <div class="date">
                            16-05-22
                        </div>
                    </div>
                </div>
            </div>

            <!-- *********** ADD EVENT *********** -->
            <div id="add-event-popup">


                <form action="add_event.php" method="POST" class="add-event-container">

                    <div class="add-event-button-container">
                        <input type="submit" class="submit" name="add_new_event" value="Submit"></input>
                        <button type="button" class="close-button" onclick="toggleAddEventPopup()">
                            <span class="cross-line" style="transform: rotate(-45deg);"></span>
                            <span class="cross-line" style="transform: rotate(45deg);"></span>
                        </button>
                    </div>

                    <div class="subjects-container">
                        <label style="font-weight: 500;" for="location">Main Information</label>
                        <input placeholder="Event name" name="name" type="text" required>
                        <input name="description" type="text" placeholder="Description" required>
                        <input name="url" type="url" placeholder="Event URL" required>
                        <input name="date" type="date" required>
                    </div>

                    <div class="subjects-container">
                        <label style="font-weight: 500;" for="country">Country & address</label>
                        <select name="country" id="country" style="width: fit-content;">
                            <option value="africa">Africa</option>
                            <option value="antarctica">Antarctica</option>
                            <option value="asia">Asia</option>
                            <option value="europe">Europe</option>
                            <option value="north america">North America</option>
                            <option value="oceania">Oceania</option>
                            <option value="south america">South America</option>
                        </select>
                        <input name="city" type="city" placeholder="City" required>
                        <input name="address" type="address" placeholder="Address" required>
                    </div>

                    <div class="subjects-container">
                        <label style="font-weight: 500;" for="location">Subjects</label>
                        <div class="row">
                            <input name="pollution" type="checkbox" value="pollution" placeholder="polluton">
                            <label for="pollution">Pollution</label>
                        </div>

                        <div class="row">
                            <input name="acidification" type="checkbox" value="acidification">
                            <label for="acidification">Acidification</label>
                        </div>
                        <div class="row">
                            <input name="rising_temperatures" type="checkbox" value="rising_temperatures">
                            <label for="rising_temperatures">Rising temperatures</label>
                        </div>

                        <div class="row">
                            <input name="eutrophication" type="checkbox" value="eutrophication">
                            <label for="eutrophication">Eutrophication</label>
                        </div>

                        <div class="row">
                            <input name="overfishing" type="checkbox" value="overfishing">
                            <label for="overfishing">Overfishing</label>
                        </div>
                    </div>


                    <div class="subjects-container">
                        <label style="font-weight: 500;" for="location"> Target audience</label>

                        <div class="row">
                            <input name="academics" type="checkbox" value="academics">
                            <label for="academics">Academics</label>
                        </div>
                        <div class="row">
                            <input name="policy_makers" type="checkbox" value="policy_makers">
                            <label for="policy_makers">Policy makers</label>
                        </div>
                        <div class="row">
                            <input name="environmentalists" type="checkbox" value="environmentalists">
                            <label for="environmentalists">Environmentalists</label>
                        </div>
                        <div class="row">
                            <input name="concerned_citizens" type="checkbox" value="concerned_citizens">
                            <label for="concerned_citizens">Concerned citizens</label>
                        </div>

                        <div class="row">
                            <input name="students" type="checkbox" value="students">
                            <label for="students">Students</label>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- *********** ABOUT US *********** -->
        <div id="about-us">

        </div>

        <!-- *********** POPUP *********** -->
        <div class="pop-up-container" id="popup">
            <div></div>

            <div id="map"></div>

            <!-- _______PHP________ -->

            <div class="text-container">

                <div class="pop-up-header">

                    <!-- __ Naam __ -->
                    <h3>Ms. Jones</h3>

                    <!-- __ Tags __ -->
                    <div class="tag">Tag</div>
                    <div class="tag">Water</div>
                    <div class="tag">Muziek</div>
                </div>

                <!-- __ Omschrijving __ -->
                <a href="https://www.google.com">Bekijk de website</a>

                <!-- __ Omschrijving __ -->
                <p>
                    Op dit album vind je naast de live versie van de nieuwe single “Freedom” ondermeer, “Red
                    Bullet”, “Raining in the Snow”, “Penthouse in Heaven” en nog veel meer mooie nummers.
                    Op dit album vind je naast de live versie van de nieuwe single “Freedom” ondermeer, “Red
                    Bullet”, “Raining in the Snow”, “Penthouse in Heaven” en nog veel meer mooie nummers.
                    Op dit album vind je naast de live versie van de nieuwe single “Freedom” ondermeer, “Red
                    Bullet”, “Raining in the Snow”, “Penthouse in Heaven” en nog veel meer mooie nummers.
                </p>

                <!-- __ Doelgroep __ -->
                <p style="font-size: .9em; font-weight: 600;">
                    Dit is een doelgroep
                </p>
            </div>
            <div class="button-container">
                <button class="close-button" onclick="togglePopup()">
                    <span class="cross-line" style="transform: rotate(-45deg);""></span>
                        <span class=" cross-line" style="transform: rotate(45deg);"></span>
                </button>
                <button class="sign-up-button">
                    Add
                    <i class="gg-add"></i>
                </button>
            </div>
        </div>

        <!-- *********** INFORMATION POPUP  *********** -->
        <div id='info-popup' class="information-popup-backdrop">
            <div class="information-popup-content" id='info'>
                <button class="close-button " onclick="toggleInfoPopup()">
                    <span class="cross-line" style="transform: rotate(-45deg);"></span>
                    <span class=" cross-line" style="transform: rotate(45deg);"></span>
                </button>
            </div>
        </div>
    </div>

    <div class="scroll-top-container"></div>
    <script src="bubbles.js"></script>
    <script src="index.js"></script>
    <script src="events.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
        defer>
    </script>
    <script src="maps.js"></script>
    <script src="handleEvents.js"></script>

    </div>
</body>