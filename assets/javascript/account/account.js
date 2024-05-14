import { exitOnClicked, showInformation } from "../function.js";

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
	showInformation(about, true);
	showInformation(subscription, false);
	showInformation(accountPage, false);
});
subscriptionButton.addEventListener("click", function () {
	showInformation(subscription, true);
	showInformation(about, false);
	showInformation(accountPage, false);
});
accountButton.addEventListener("click", function () {
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
