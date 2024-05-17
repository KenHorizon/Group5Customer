import {
	subscriptionButton,
	getData,
	removeData,
	saveData,
	showInformation,
	exitOnClicked,
} from "../function.js";

let checkbox = document.getElementById("checkbox");
let advanceSubscriptionYear = document.getElementById("advanceSubscriptionYear");
let advanceSubscriptionMonth = document.getElementById("advanceSubscriptionMonth");
let basicSubscriptionYear = document.getElementById("basicSubscriptionYear");
let basicSubscriptionMonth = document.getElementById("basicSubscriptionMonth");

subscriptionButton(basicSubscriptionButton);
subscriptionButton(advanceSubscriptionButton);

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

exitOnClicked(subscriptionBasic, false);
exitOnClicked(subscriptionAdvance, false);
exitOnClicked(termConditionsPopup, false);

// exitOnClicked(function() {
// 	basicSubscriptionMonthCheck.checked = false;
// 	basicSubscriptionYearCheck.checked = true;
// 	advanceSubscriptionMonthCheck.checked = false;
// 	advanceSubscriptionYearCheck.checked = true;
// });
checkbox.addEventListener("click", function () {
	if (checkbox.checked) {
		saveData("alreadyReadTermAndConditions", true);
	} else {
		removeData("alreadyReadTermAndConditions");
	}
	console.log(checkbox.checked);
});

window.onload = function () {
	checkbox.checked = getData("alreadyReadTermAndConditions");
};
