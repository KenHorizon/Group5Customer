
let subscription = document.getElementById("subscriptionPage");
let about = document.getElementById("aboutPage");

function aboutButton() {
	subscription.style.display = "";
	about.style.display = "block";
}
function subscriptionButton() {
	subscription.style.display = "block";
	about.style.display = "none";
}
