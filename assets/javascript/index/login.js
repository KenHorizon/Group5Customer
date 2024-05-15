// Variables
// Remember Me Password Script
import { getData, removeData, saveData } from "../function.js";

const passwordInput = document.getElementById("rememberPasswordInput");
const rememberPassword = document.getElementById("checkboxRememberPassword");

rememberPassword.addEventListener("change", function () {
	if (rememberPassword.checked) {
		saveData("rememberPasswordData", passwordInput.value);
		saveData("rememberPasswordCheckData", rememberPassword.checked);
	} else {
		removeData("rememberPasswordCheckData");
		removeData("rememberPasswordData");
	}
});

window.onload = function () {
	// Check if password have
	if (passwordInput.value === "undefined" || passwordInput.value === "") {
		passwordInput.value = getData("rememberPasswordData");
		rememberPassword.checked = getData("rememberPasswordCheckData");
	} else {
		removeData("rememberPasswordCheckData");
		removeData("rememberPasswordData");
	}
	console.log(getData("rememberPasswordData"));
};
