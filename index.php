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

<body>
    <div class="main" id="main">
        <div class="header" id="header" style="padding: var(--gutter-l);">
            <p style="position: absolute; font-size: .6em; opacity: .5; top: var(--gutter-l);">Click anywhere to create
                bubbles!</p>
            <div class="login-container">
                <?php if(!isset($_SESSION['username'])) : ?>
                <button class="login" onclick="window.location.href='./login';">
                    <i class="gg-user"></i> Log In
                </button>
                <div class="sign-up-button">
                    <a href="./login/registration.php">Or Sign Up</a>
                </div>
                <?php else : ?>
                <button class="login" onclick="window.location.href='index.php';">
                    <i class="gg-user"></i> <?php echo $_SESSION['username']?>
                </button>
                <div class="sign-up-button">
                    <a href="logout.php">Log Out</a>   
                </div>             
                <?php endif; ?>
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
                        <option value="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands">Åland Islands</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Republic of">South Korea</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands, The</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-leste">Timor-leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
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
    </div>
</body>

</html>