<!-- Zrobić walidacje danych tzn. zeby w polach nie mogły być wyższe i niższe liczby, oraz zeby nie mogły się tam znajodwać litery i białe znaki -->

<!DOCTYPE html>
<html>
    <head>
        <title>Pong game</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="main_page">
    <canvas id="canvas" hidden="true" ></canvas>

    <?php
    session_start();
    function __autoload($class_name) {
        include "Class/".$class_name . '.php' ;
    }
    $user = new Register_new;
    $_SESSION["user"] = $user;
    if ( ! $user->_is_logged() )
    { ?>
    <div id="gameDiv">
    <p class="paragraph">
        <a id="a" style="color: #d22d2d; font-style: italic;">Enter parameters (both must be within the given range and must be numbers):<br><br><br><a>
        Computer speed (0-15): &emsp;<input type="text" id="compSpeed" size="1" name="computerSpeed" oninput="checkFields()"><br>
        Ball speed (1-6): &nbsp; &ensp;&emsp;&emsp;&emsp;<input type="text" id="ballSpeed" size="1" name="ballSpeed" oninput="checkFields()">
    </p>
    </div>
    
    <button id="not_logged_button" class="top_button" disabled onclick="play();saveParamstoLocalStorage()">Play</button>
    <button id="sign_in" class="button" onclick="location.href='HTML/logowanie.html'" >Sign in</button><br>
    <button id="reg" class="button" onclick="location.href='HTML/rejestracja.html'">Register</button>
    <button id="params" class="button" onclick="loadLocalStorageParameters()">Last parameters</button>

    <?php }else{?>
    <div id="formDiv">
        <form class="paragraph"method="post" action="PHP/dodaj.php">
            <a id="a" style="color:#d22d2d;font-style: italic;">Enter parameters (both must be within the given range and must be numbers):<a> <br><br><br>
            Computer speed (0-15): &emsp;<input type="text" id="compSpeed" size="1" name="computerSpeed" oninput="checkFields()"><br>
            Ball speed (1-6): &nbsp; &ensp;&emsp;&emsp;&emsp;<input type="text" id="ballSpeed" size="1" name="ballSpeed" oninput="checkFields()"> <br>
            <input type="submit" id="save_button" disabled value="Save"> <br>
        </form>
    </div>       
    <div id="gameDiv">
        <p>
            <button type ="button" id="logged_button" class="top_button" disabled onclick="play()">Play</button>
            <button type ="button" id="parameters" class="button" onclick="location.href='PHP/parametry.php'">Saved parameters</button>
            <button type ="button" id="log_out" class="button" onclick="location.href='PHP/wylogowanie.php'">Log out</button>
        </p>
    </div>
    <?php }?>

    <script>
        function checkFields() {
            const computerSpeedField = document.getElementById('compSpeed');
            const ballSpeedField = document.getElementById('ballSpeed');
            const saveButton = document.getElementById('save_button');
            const aTag = document.getElementById('a');
            let button;
            if(document.getElementById('not_logged_button')) 
                button = document.getElementById('not_logged_button');
            if(document.getElementById('logged_button'))
                button = document.getElementById('logged_button')

            if (computerSpeedField.value && ballSpeedField.value && computerSpeedField.value >= 0 && computerSpeedField.value <= 15 && ballSpeedField.value >= 1 && ballSpeedField.value <= 6 ) {
                aTag.style.color = 'white';
                button.disabled = false;
                saveButton.disabled = false;
            } else {
                aTag.style.color = '#d22d2d';
                button.disabled = true;
                saveButton.disabled = true;
            }   
        }

        function play(){
            game(document.getElementById('compSpeed').value, document.getElementById('ballSpeed').value);

            if(document.getElementById("formDiv"))
                document.getElementById("formDiv").style.display = "none";
            if(document.getElementById("gameDiv"))
                document.getElementById("gameDiv").style.display = "none";
        }
        function saveParamstoLocalStorage(){
            const computerSpeedField = document.getElementById('compSpeed');
            const ballSpeedField = document.getElementById('ballSpeed');
            const paramsButton = document.getElementById('params');
            
            localStorage.setItem('computerSpeed', computerSpeedField.value);
            localStorage.setItem('ballSpeed', ballSpeedField.value);
            console.log(localStorage.getItem('computerSpeed'));
            console.log(localStorage.getItem('ballSpeed'));

        }
        function loadLocalStorageParameters(){
            const computerSpeedField = document.getElementById('compSpeed');
            const ballSpeedField = document.getElementById('ballSpeed');

            computerSpeedField.value = localStorage.getItem('computerSpeed');
            ballSpeedField.value = localStorage.getItem('ballSpeed');
            checkFields();
        }
    </script>
    <script src="script.js"></script>
    </body>
</html>
