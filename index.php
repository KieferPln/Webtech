<?php
    session_start();
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>	
<script> 	
</script>

<body>
    <div class="main" id="main">
        <div class="header" id="header" style="padding: var(--gutter-l);">
            <p style="position: absolute; font-size: .6em; opacity: .5; top: var(--gutter-l);">Click anywhere to create bubbles! <br><br> <span id="bubble-count"></span></p>
            <div class="login-container">

                <!--if the user is not logged in, the log in and the register button will be displayed -->
                <?php if(!isset($_SESSION['username'])) : ?>
                <button class="login" onclick="window.location.href='./login/login.php';">
                    <i class="gg-user"></i> Log In
                </button>
                <div class="sign-up-button">
                    <a href="./login/register.php">Or Sign Up</a>
                </div>
                
                <!--if the user is logged in, show the username -->
                <?php else : ?>
                    <button class="login" onclick="window.location.href='index.php';">
                    <i class="gg-user"></i> <?php echo $_SESSION['username']?>
                </button>
                <div class="dropdown-content">
                    <a href="../login/change_password.php">Change Password</a>
                    <a href="../login/change_email.php">Change Email</a>
                    <a href="logout.php">Log Out</a>
                </div>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['database-error'])) : ?>
                <div class="alert-danger">
                    <?php echo $_SESSION['database-error'];
                          unset($_SESSION['database-error']);?>
                </div>
            <?php endif; ?>
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
                
                <!-- if username is set to 'admin', show 'add event' button in navigation bar -->
                <?php if(ISSET($_SESSION['username']) and $_SESSION['username'] == 'admin') : ?>
                <li id="nav_add_event" onclick="toggleAddEventPopup()">Add Event *</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- *********** COOKIE *********** -->
        <div id="cookies">
            <div class="cookie-container">
                <div class="cookie-subcontainer">
                    <div class="cookies">
                        <br>
                        <p style='text-align:center'>This website uses cookies to ensure you get the best experience on our website.
                            <a style='font-weight:bold' onclick="toggleInfoPopup('privacy')">
                            More info
                            </a>
                        </p>
                        <br>
                        <div class="cookie-btns">
                            <button style='display: grid; margin:auto; color:black; font-weight:bold' id="cookie-btn">Accept</button>
                            <button style='display: grid; margin:auto; color:black; font-weight:bold' id="decline-btn">Decline</button>
                        </div>
                        <br>
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
                            (Plastic) Pollution
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
                    <div onclick="toggleInfoPopup('Acidification')" class="tile">
                        <div class="tile-content-container">
                            Acidification
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Temperatures')" class="tile">
                        <div class="tile-content-container">
                            Rising Temperatures
                        </div>
                    </div>
                    <div onclick="toggleInfoPopup('Sources')" class="tile">
                        <div class="tile-content-container">
                            Research & Our Sources
                        </div>
                    </div>
                </div>
            </div>

            <!-- *********** EVENTS *********** -->
            <div id="events">
            <div class="column">
                    <h2>Upcoming Events</h2>
                    <div class="row">
                        <select id='select-subject'onchange="filterEventsbySubjects()" name="Filter">
                            <option value="">All subjects</option>    
                            <option value="Pollution">Pollution</option>
                            <option value="Acidification">Acidification</option>
                            <option value="Rising Temperatures">Rising Temperatures</option>
                            <option value="Eutrophication">Eutrophication</option>
                            <option value="Overfishing">Overfishing</option>                                                
                        </select>
                        
                        <select name="Filter">
                            <option value="">All audiences</option>
                            <option value="Pollution">Academics</option>
                            <option value="Acidification">Policy Makers</option>
                            <option value="Rising Temperatures">Environmentalists</option>
                            <option value="Eutrophication">Concerned Citizens</option>
                            <option value="Overfishing">Students</option> 
                        </select>
                        <button class="favorites">Show favorites</button>
                    </div>
                </div>
                <div id='event-container' class=" event-container"> 	
    
                </div>

            <!-- *********** ADD EVENT *********** -->
            
            <!-- the form is long because there are 150+ countries in the drop
            down list so we put it in a seperate file  -->
            <script> 
                $(function(){
                $("#event_form").load("event_form.php"); 
                });
            </script> 
            
            <div id="add-event-popup">
                <div id="event_form"> </div>
            </div>

        <!-- *********** ABOUT US *********** -->
            <div id="about_us">
                <h2 style="margin-top: var(--gutter-m); text-align:center">About Us</h2> 
                <br>
            <iframe
            loading="lazy"
            allowfullscreen
                    width=200,
                    heigth=200
            referrerpolicy="no-referrer-when-downgrade"
            src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q=52.3538275,4.956128">
            </iframe>
                <p style='font-weight:300'>Welcome to our website, created by a group of five first-year students studying Artificial Intelligence at the University of Amsterdam.</p>
                <p style='font-weight:300'>Our names are Daan Keller, Colin de Koning, Kiefer Plender, Julius de Groot & Milan Tool.</p>
                <br>
                <p style='font-weight:300'>Our website is dedicated to raising awareness about the United Nations' Sustainable Development Goal 14: 'Life Below Water.'</p>
                <p style='font-weight:300'>Here, you will find information about current problems facing our oceans and the risks they pose to marine life and human communities.</p>
                <p style='font-weight:300'>We created this website from scratch as a way to educate and inform the public about the importance of protecting our oceans.</p>
                <p style='font-weight:300'>Join us in our mission to conserve and sustainably use the oceans, seas, and marine resources for sustainable development by educating yourself on this topic.</p>
                <p>You've visited this website 
            </div>
        </div>

        <!-- *********** POPUP *********** -->
        <div class="pop-up-container" id="popup">
            <div></div>

            <iframe
            loading="lazy"
            allowfullscreen
            id="iframe-maps"
            referrerpolicy="no-referrer-when-downgrade"
            src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q=Space+Needle,Seattle+WA">
            </iframe>
            <div class="text-container">
                <div class="pop-up-header">
                    <!-- _ Naam _ -->
                    <h3 id='event-name'></h3>
                    <div id="event-tags"></div>
                </div>

                <!-- _ Omschrijving _ -->
                <a id='event-url'>Bekijk de website</a>

                <!-- _ Omschrijving _ -->
                <p id='event-description'></p>

                <!-- _ Doelgroep _ -->
                <!-- <p style="font-size: .9em; font-weight: 600;">
                    Dit is een doelgroep
                </p> -->
                <p id='event-audience'></p>
            </div>
            <div class="button-container">
                <button class="close-button" onclick="togglePopup()">
                    <span class="cross-line" style="transform: rotate(-45deg);"></span>
                        <span class=" cross-line" style="transform: rotate(45deg);"></span>
                </button>
                <?php if(isset($_SESSION['username'])) : ?>	
                <button class="sign-up-button">
                    <i class="gg-add"></i>
                <?php endif; ?>	
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
    <script src="handleEvents.js"></script>
    <script src="bubbles.js"></script>
    <script src="index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
        defer>
    </script>
    <script src="maps.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</body>

</html>