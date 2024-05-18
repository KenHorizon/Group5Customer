import {
	exitOnClicked,
	getData,
	saveData,
	showInformation,
} from "../function.js";

let subscription = document.getElementById("subscriptionPage");
let about = document.getElementById("aboutPage");

aboutButton.addEventListener("click", function () {
	if (
		getData("previousClicked") === " " ||
		getData("previousClicked") === "undefined"
	) {
		remove("previousClicked");
	} else {
		saveData("previousClicked", about.id);
	}
	showInformation(about, true);
	showInformation(subscription, false);
	showInformation(accountPage, false);
});
subscriptionButton.addEventListener("click", function () {
	if (
		getData("previousClicked") === " " ||
		getData("previousClicked") === "undefined"
	) {
		remove("previousClicked");
	} else {
		saveData("previousClicked", subscription.id);
	}
	showInformation(subscription, true);
	showInformation(about, false);
	showInformation(accountPage, false);
});

window.onload = function () {
	if (getData("previousClicked") !== aboutPage.id) {
		showInformation(document.getElementById(aboutPage.id), false);
		showInformation(document.getElementById(getData("previousClicked")), true);
	} else {
		showInformation(document.getElementById(getData("previousClicked")), true);
	}
};
