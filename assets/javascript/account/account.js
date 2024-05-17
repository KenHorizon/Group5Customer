import {
	exitOnClicked,
	getData,
	saveData,
	showInformation,
} from "../function.js";

let introduction = document.getElementById("introduction");

let subscription = document.getElementById("subscriptionPage");
let about = document.getElementById("aboutPage");
let accountPage = document.getElementById("accountPage");

let deactivatedAccountBox = document.getElementById("deactivatedAccountBox");
let termService = document.getElementById("termService");
let privacyPolicy = document.getElementById("privacyPolicy");
let cookiePolicy = document.getElementById("cookiePolicy");
let applyAdmin = document.getElementById("applyAdmin");
let contactUs = document.getElementById("contactUs");

exitOnClicked(deactivatedAccountBox);

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
accountButton.addEventListener("click", function () {
	if (
		getData("previousClicked") === " " ||
		getData("previousClicked") === "undefined"
	) {
		remove("previousClicked");
	} else {
		saveData("previousClicked", accountPage.id);
	}
	showInformation(about, false);
	showInformation(subscription, false);
	showInformation(accountPage, true);
});

deactivatedAccount.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, true);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});

termServiceButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, true, "hide");
	showInformation(introduction, false);
	showInformation(termService, true);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});

privacyPolicyButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, true);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
privacyPolicyButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, true);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
cookiePolicyButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, true);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
applyAdminButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, true);
	showInformation(contactUs, false);
});
contactUsButton.addEventListener("click", function () {
	showInformation(deactivatedAccountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, true);
});
window.onload = function () {
	let clock = document.getElementById("digitalClock");
	if (getData("digitalClockConfig")) {
		clock.checked = true;
		digitalClockDisplay.style.display = "flex";
	} else {
		digitalClockDisplay.style.display = "none";
	}
	if (getData("previousClicked") !== aboutPage.id) {
		showInformation(document.getElementById(aboutPage.id), false);
		showInformation(document.getElementById(getData("previousClicked")), true);
	} else {
		showInformation(document.getElementById(getData("previousClicked")), true);
	}
};