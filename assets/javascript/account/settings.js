import { saveData, getData, removeData } from "../function.js";
let clock = document.getElementById("digitalClock");

clock.onchange = function () {
	if (clock.checked) {
		digitalClockDisplay.style.display = "flex";
		saveData("digitalClockConfig", clock.checked);
	} else {
		removeData("digitalClockConfig");
		digitalClockDisplay.style.display = "none";
	}
};
