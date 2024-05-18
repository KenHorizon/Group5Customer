import {
	exitOnClicked,
	getData,
	saveData,
	removeData,
	showInformation,
} from "../function.js";

let introduction = document.getElementById("introduction");
let accountBox = document.getElementById("accountBox");
let securityPage = document.getElementById("securityPage");
let termService = document.getElementById("termService");
let privacyPolicy = document.getElementById("privacyPolicy");
let cookiePolicy = document.getElementById("cookiePolicy");
let applyAdmin = document.getElementById("applyAdmin");
let contactUs = document.getElementById("contactUs");


accountButton.addEventListener("click", function () {
	showInformation(securityPage, false);
	showInformation(accountBox, true);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});

termServiceButton.addEventListener("click", function () {
	showInformation(termService, true);
	showInformation(securityPage, false);
	showInformation(accountBox, false);
	showInformation(introduction, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});

securityButton.addEventListener("click", function () {
	showInformation(securityPage, true);
	showInformation(accountBox, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
privacyPolicyButton.addEventListener("click", function () {
	showInformation(accountBox, false);
	showInformation(securityPage, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, true);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
cookiePolicyButton.addEventListener("click", function () {
	showInformation(cookiePolicy, true);
	showInformation(accountBox, false);
	showInformation(securityPage, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(applyAdmin, false);
	showInformation(contactUs, false);
});
applyAdminButton.addEventListener("click", function () {
	showInformation(applyAdmin, true);
	showInformation(accountBox, false);
	showInformation(securityPage, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(contactUs, false);
});
contactUsButton.addEventListener("click", function () {
	showInformation(contactUs, true);
	showInformation(accountBox, false);
	showInformation(securityPage, false);
	showInformation(introduction, false);
	showInformation(termService, false);
	showInformation(privacyPolicy, false);
	showInformation(cookiePolicy, false);
	showInformation(applyAdmin, false);
});
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