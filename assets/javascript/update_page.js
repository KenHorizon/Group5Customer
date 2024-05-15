function updatePages() {
	var updatePage = new XMLHttpRequest();
	updatePage.onreadystatechange = function() {
		if (this.readyState === 4 || this.status === 200) {
			document.getElementById("update").innerHTML = this.responseText;
		}
	};
	updatePage.open("GET", "assets/php/subscription.php", true);
	updatePage.send();
}
updatePages();
setInterval(updatePages, 1);