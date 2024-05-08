// Message box Script
// No variables, it's used by ID
// Cant create a single variables to all id, it break the codes, it must done separately and manually
import {
	messageBox,
	subscriptionButton,
	getData,
	removeData,
	saveData,
} from "./function.js";

const checkbox = document.getElementById("checkbox");

subscriptionButton(basicSubscriptionButton);
subscriptionButton(advanceSubscriptionButton);
messageBox(subscriptionBasic);
messageBox(subscriptionAdvance);
messageBox(termConditionsPopup);

profilePictureEdit.addEventListener("click", function () {
	editProfilePopup.classList.add("show");
});
termConditions.addEventListener("click", function () {
	termConditionsPopup.classList.add("show");
});
basicSubscriptionExitButton.addEventListener("click", function () {
	subscriptionBasic.classList.remove("show");
});
advanceSubscriptionExitButton.addEventListener("click", function () {
	subscriptionAdvance.classList.remove("show");
});
termConditionsClose.addEventListener("click", function () {
	termConditionsPopup.classList.remove("show");
});

basicSubscriptionYearCheck.addEventListener("click", function () {
	basicSubscriptionYear.classList.add("show");
	basicSubscriptionMonth.classList.remove("show");
});

basicSubscriptionMonthCheck.addEventListener("click", function () {
	basicSubscriptionMonth.classList.add("show");
	basicSubscriptionYear.classList.remove("show");
});

advanceSubscriptionYearCheck.addEventListener("click", function () {
	advanceSubscriptionYear.classList.add("show");
	advanceSubscriptionMonth.classList.remove("show");
});


const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			basicSubscriptionMonthCheck.checked = false;
			basicSubscriptionYearCheck.checked = true;
			advanceSubscriptionMonthCheck.checked = false;
			advanceSubscriptionYearCheck.checked = true;
			subscriptionBasic.classList.remove("show");
			subscriptionAdvance.classList.remove("show");
			termConditionsPopup.classList.remove("show");
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
