function subscriptions() {
	var autoSave;
	autoSave = new XMLHttpRequest();
	autoSave.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("subscriptions").innerHTML = this.responseText;
		}
	};
	if (!document.getElementById(checkboxName).checked) {
		autoSave.open("GET", "assets/php/settings/subscriptions.php", true);
		autoSave.send();
	}
}