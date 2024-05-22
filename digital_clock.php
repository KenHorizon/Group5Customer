<!DOCTYPE html>
<html lang="en">
<body>
    <div class="clock-container" id="digitalClockDisplay" style="display: <?php echo  $user->config()['digital_clock'] == 1 ? "flex" : "none";?>">
        <p class="icon-texts" style="font-size: 10px;"><i class="material-icons">schedule</i>
        <div class="clock-container-body">
            <div id="clock">00:00:00 </div>
        </div>
        </p>
    </div>
    <script src="assets/javascript/digital_clock.js"></script>
</body>

</html>