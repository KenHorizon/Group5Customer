// function updatePages() {
// 	var updatePage = new XMLHttpRequest();
// 	updatePage.onreadystatechange = function() {
// 		if (this.readyState === 4 || this.status === 200) {
// 			document.getElementById("update").innerHTML = this.responseText;
// 		}
// 	};
// 	updatePage.open("GET", "assets/php/subscriptions.php", true);
// 	updatePage.send();
// }
// updatePages();
// setInterval(updatePages, 1);
let updateDatabase0 = document.getElementById("updateDatabase0");
let updateDatabase1 = document.getElementById("updateDatabase1");
function updatePages() {
	updateDatabase1.scr = URL.createObjectURL("/assets/img/subscription/badge.png");
	console.log(updateDatabase1.src);
	updateDatabase0.scr = "";
}
updatePages();
setInterval(updatePages, 1);