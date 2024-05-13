let introduction = document.getElementById("introduction");
let subscription = document.getElementById("subscriptionPage");
let about = document.getElementById("aboutPage");
let accountPage = document.getElementById("accountPage");
let termService = document.getElementById("termService");
let privacyPolicy = document.getElementById("privacyPolicy");
let cookiePolicy = document.getElementById("cookiePolicy");
let applyAdmin = document.getElementById("applyAdmin");
let contactUs = document.getElementById("contactUs");

function aboutButton() {
	subscription.style.display = "none";
	about.style.display = "block";
	accountPage.style.display = "none";
}
function subscriptionButton() {
	subscription.style.display = "block";
	about.style.display = "none";
	accountPage.style.display = "none";
}
function accountButton() {
	subscription.style.display = "none";
	about.style.display = "none";
	accountPage.style.display = "flex";
}

function termServiceButton() {
	introduction.style.display = "none";
	termService.style.display = "block";
	privacyPolicy.style.display = "none";
	cookiePolicy.style.display = "none";
	applyAdmin.style.display = "none";
	contactUs.style.display = "none";
}
function privacyPolicyButton() {
	introduction.style.display = "none";
	termService.style.display = "none";
	privacyPolicy.style.display = "block";
	cookiePolicy.style.display = "none";
	applyAdmin.style.display = "none";
	contactUs.style.display = "none";
}
function cookiePolicyButton() {
	introduction.style.display = "none";
	termService.style.display = "none";
	privacyPolicy.style.display = "none";
	cookiePolicy.style.display = "block";
	applyAdmin.style.display = "none";
	contactUs.style.display = "none";
}
function applyAdminButton() {
	termService.style.display = "none";
	privacyPolicy.style.display = "none";
	cookiePolicy.style.display = "none";
	applyAdmin.style.display = "block";
	contactUs.style.display = "none";
}
function contactUsButton() {
	introduction.style.display = "none";
	termService.style.display = "none";
	privacyPolicy.style.display = "none";
	cookiePolicy.style.display = "none";
	applyAdmin.style.display = "none";
	contactUs.style.display = "block";
}
