import { saveData, getData, removeData } from "../function.js";
let clock = document.getElementById("digitalClock");

window.onload = function () {
	if (getData("digitalClockConfig")) {
		clock.checked = true;
		digitalClockDisplay.style.display = "flex";
	} else {
		digitalClockDisplay.style.display = "none";
	}
};

clock.onchange = function () {
	if (clock.checked) {
		digitalClockDisplay.style.display = "flex";
		saveData("digitalClockConfig", clock.checked);
	} else {
		removeData("digitalClockConfig");
		digitalClockDisplay.style.display = "none";
	}
};
