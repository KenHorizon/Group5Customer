// Message box Script
// No variables, it's used by ID
// Cant create a single variables to all id, it break the codes, it must done separately and manually
import {
	messageBox,
	subscriptionButton,
	getData,
	removeData,
	saveData,
	showInformation
} from "./function.js";

const checkbox = document.getElementById("checkbox");
const advanceSubscriptionYear = document.getElementById("advanceSubscriptionYear");
const advanceSubscriptionMonth = document.getElementById("advanceSubscriptionMonth");
const basicSubscriptionYear = document.getElementById("basicSubscriptionYear");
const basicSubscriptionMonth = document.getElementById("basicSubscriptionMonth");

subscriptionButton(basicSubscriptionButton);
subscriptionButton(advanceSubscriptionButton);

messageBox(subscriptionBasic);
messageBox(subscriptionAdvance);
messageBox(termConditionsPopup);

termConditions.addEventListener("click", function () {
	showInformation(termConditionsPopup, true);
});
basicSubscriptionExitButton.addEventListener("click", function () {
	showInformation(subscriptionBasic, false);
});
advanceSubscriptionExitButton.addEventListener("click", function () {
	showInformation(subscriptionAdvance, false);
});
termConditionsClose.addEventListener("click", function () {
	showInformation(termConditionsPopup, false);
});

basicSubscriptionYearCheck.addEventListener("click", function () {
	showInformation(basicSubscriptionYear, true);
	showInformation(basicSubscriptionMonth, false);
	console.log("Test!");
});

basicSubscriptionMonthCheck.addEventListener("click", function () {
	showInformation(basicSubscriptionYear, false);
	showInformation(basicSubscriptionMonth, true);
});

advanceSubscriptionMonthCheck.addEventListener("click", function () {
	showInformation(advanceSubscriptionYear, false);
	showInformation(advanceSubscriptionMonth, true);
});
advanceSubscriptionYearCheck.addEventListener("click", function () {
	showInformation(advanceSubscriptionYear, true);
	showInformation(advanceSubscriptionMonth, false);
});


const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			basicSubscriptionMonthCheck.checked = false;
			basicSubscriptionYearCheck.checked = true;
			advanceSubscriptionMonthCheck.checked = false;
			advanceSubscriptionYearCheck.checked = true;
			showInformation(subscriptionBasic, false);
			showInformation(subscriptionAdvance, false);
			showInformation(termConditionsPopup, false);
			break;
	}
	console.log(e.key); // Allow to see what key bind is selected!
};

window.addEventListener("keydown", handleMovement);

checkbox.addEventListener("click", function () {
	if (checkbox.checked) {
		saveData("alreadyReadTermAndConditions", true);
	} else {
		removeData("alreadyReadTermAndConditions");
	}
	console.log(checkbox.checked);
});

window.onload = function () {
	checkbox.checked = getData(
		"alreadyReadTermAndConditions"
	);
};
