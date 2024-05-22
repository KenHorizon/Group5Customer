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
                <p id="1" style="margin-left: 0.55em;"><span id="digitalClock"></span></p>
                <input type="checkbox" name="1" onclick="digitalClockConfig('1')">
                <input type="checkbox" name="2" onclick="digitalClockConfig('2')">
                <label style="margin-left: 0.55em;">Digital Clock</label>
            </div>
        </div>
        <input type="submit" style="margin: 0 25%;" value="Save">
        </div>

    </form>
    <script>
        function digitalClockConfig(data) {
            var autoSave;
            autoSave = new XMLHttpRequest();
            autoSave.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("digitalClock").innerHTML = this.responseText;
                }
            };
            autoSave.open("GET", "setting_functions.php?q=" + data, true);
            autoSave.send();
        }
    </script>
</body>

</html>