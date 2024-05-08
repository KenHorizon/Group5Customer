// Variables

function searchFunctions() {
	var input, filter, menu, toSearch, toSearch, i;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	menu = document.getElementById("menu");
	toSearch = document.getElementById("toSearch");

	for (i = 0; i < toSearch.length; i++) {
		get = toSearch[i].getElementsByTagName("th")[0];
		if (get.innerHTML.toUpperCase().indexOf(filter) > -1) {
			toSearch[i].style.display = "";
		} else {
			toSearch[i].style.display = "none";
		}
	}
}
