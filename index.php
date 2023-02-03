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
    <div id="main">
        <div id="header">
            <div class="header-top">

                <div style="font-size: .8em; letter-spacing: 1px; color: rgb(180, 180, 180);">
                    <p>
                        Click anywhere to
                        create
                        bubbles!
                    </p>
                    <br>
                    <p id="bubble-count"></p>
                </div>


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
                        <i class="gg-user"></i>
                        <?php echo $_SESSION['username']?>
                    </button>
                    <div class="dropdown-content">
                        <a href="../login/change_password.php">Change Password</a>
                        <a href="../login/change_email.php">Change Email</a>
                        <a href="logout.php">Log Out</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="header-middle">
                <h1>Life Below Water</h1>
                <h2 style="width: 80%">Conserve and sustainably use the oceans, seas and marine resources for
                    sustainable development.</h2>
            </div>

            <?php if (isset($_SESSION['database-error'])) : ?>
            <div class="alert-danger">
                <?php echo $_SESSION['database-error'];
                          unset($_SESSION['database-error']);?>
            </div>
            <?php endif; ?>
            <div id="bubble-layer"></div>
        </div>

        <!-- NAV -->
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
                        <p style='text-align:center'>This website uses cookies to ensure you get the best experience on
                            our website.
                            <a style='font-weight:bold' onclick="toggleInfoPopup('privacy')">
                                More info
                            </a>
                        </p>
                        <br>
                        <div class="cookie-btns">
                            <button style='display: grid; margin:auto; color:black; font-weight:bold'
                                id="cookie-btn">Accept</button>
                            <button style='display: grid; margin:auto; color:black; font-weight:bold'
                                id="decline-btn">Decline</button>
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
                <h2 style="color: white;">Information</h2>
                <div class="tile-container">
                    <script>
                        var topics = ['General Information', '\(Plastic\) Pollution',
                            'Overfishing', 'Eutrophication', 'Acidification',
                            'Rising Temperatures', 'Research & Our Sources'];
                        for (var i = 0; i < topics.length; i++) {
                            document.write(`
                                <div onclick="toggleInfoPopup('${topics[i]}')" class="tile">
                                    <div class="tile-content-container">
                                        ${topics[i]}
                                    </div>
                                </div>
                            `);
                        }
                    </script>
                </div>
            </div>

            <!-- *********** EVENTS *********** -->
            <div id="events" style="overflow-y: scroll;">
                <div class="column">
                    <h2 style="position: sticky; left: 0px;">Upcoming Events</h2>
                    <div class="row" style='width: 100%; overflow: scroll;'>
                        <select id='select-subject' onchange="filterEventsbySubjects()" name="Filter-subjects">
                            <option value="">All subjects</option>
                            <option value="Pollution">Pollution</option>
                            <option value="Acidification">Acidification</option>
                            <option value="Rising Temperatures">Rising Temperatures</option>
                            <option value="Eutrophication">Eutrophication</option>
                            <option value="Overfishing">Overfishing</option>
                        </select>

                        <select id='select-audience' onchange="filterEventsbyAudience()" name="Filter-audience">
                            <option value="">All audiences</option>
                            <option value="Academics">Academics</option>
                            <option value="Policy Makers">Policy Makers</option>
                            <option value="Environmentalists">Environmentalists</option>
                            <option value="Concerned Citizens">Concerned Citizens</option>
                            <option value="Students">Students</option>
                        </select>
                        <button class="favorites" onclick="showFavorites()">Show favorites</button>
                    </div>
                </div>

                <div id='event-container' class=" event-container"></div>
                <!-- *********** ADD EVENT *********** -->

                <!-- the form is long because there are 150+ countries in the drop
                down list so we put it in a seperate file  -->
                <script>
                    $(function () {
                        $("#event_form").load("event_form.php");
                    });
                </script>

                <div id="add-event-popup">
                    <div id="event_form"> </div>
                </div>

                <div class="gap"></div>

                <!-- *********** ABOUT US *********** -->
            </div>

            <div id="about_us" style="display: flex; flex-direction: column; gap: var(--gutter-m);">
                <h2 style="text-align:center; color: white;">About Us (Dit is een footer,
                    Milan.)</h2>
                <div class="content">
                    <!-- <iframe loading="lazy" allowfullscreen width=100%, heigth=300
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDXSG_YOOUXxeFLXwEREWCCaPPnIead_EI&q=52.3538275,4.956128">
                    </iframe> -->

                    Welcome to our website, created by a group of five first-year
                    students
                    studying Artificial Intelligence at the University of Amsterdam.
                    Our names are Daan Keller, Colin de Koning, Kiefer Plender,
                    Julius de
                    Groot & Milan Tool.
                    <br>
                    <br>
                    Our website is dedicated to raising awareness about the United
                    Nations'
                    Sustainable Development Goal 14: 'Life Below Water.'
                    Here, you will find information about current problems facing our
                    oceans
                    and the risks they pose to marine life and human communities.
                    We created this website from scratch as a way to educate and
                    inform
                    the
                    public about the importance of protecting our oceans.
                    Join us in our mission to conserve and sustainably use the
                    oceans,
                    seas,
                    and marine resources for sustainable development by educating yourself on this topic.
                </div>
            </div>

            <!-- *********** POPUP *********** -->
            <div class="pop-up-container" id="popup">
                <div class="text-container">
                    <div class="pop-up-header">
                        <h3 id='event-name'></h3>
                        <div id="event-tags"></div>
                    </div>
                    <a id='event-url'>Visit their website</a>
                    <p id='event-description'></p>
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
                    <div class="information-popup-header" id="info-header">
                        <button class="close-button " onclick="toggleInfoPopup()">
                            <span class="cross-line" style="transform: rotate(-45deg);"></span>
                            <span class=" cross-line" style="transform: rotate(45deg);"></span>
                        </button>
                        <h2 id="info-header-text"></h2>
                    </div>

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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <footer>
            <p style="font-size: .6em;">Copyright © 2023 Life Below Water, UvA 🫧</p>
        </footer>
    </div>
</body>

</html>