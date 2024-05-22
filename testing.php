<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.ico">
    <title>Beyond Horizon: Stars | Forgot Password</title>
    <link rel="stylesheet" href="assets/css/input_box.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- CSS SCRIPT HANDLE CUSTOMIZED ADDITIONS OF HTML -->
    <link rel="stylesheet" href="assets/css/icons_addon.css"> <!-- ICONS API -->

</head>


<body>
    <form method="POST">
        <div class="group-box-column-names" style="color:white;">
            <div style="margin: 0 25%;">
                <p style="margin-left: 0.55em;"><span id="digitalClock"></span></p>
                <div class="slider-button">
                    <label class="switch">
                        <input type="checkbox" id="digitalClockConfig" name="digitalClockConfig">
                        <span class="slider round"></span>
                    </label>
                    <label style="margin-left: 0.55em;" >Digital Clock</label>
                </div>
            </div>
            <input type="submit" style="margin: 0 25%;" value="Save">
        </div>

    </form>
    <script>
        function digitalClockConfig() {
            var autoSave;
            autoSave = new XMLHttpRequest();
            autoSave.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("digitalClock").innerHTML = this.responseText;
                }
            };
            autoSave.open("GET", "settings_function.php", true);
            autoSave.send();
        }
    </script>
</body>

</html>