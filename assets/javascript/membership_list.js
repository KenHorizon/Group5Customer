import {
	messageBox,
	subscriptionButton,
	getData,
	removeData,
	saveData,
} from "./function.js";

messageBox(reasonMessageBox);

confirmButton.addEventListener("click", function () {
	confirmationMessageBox.classList.add("show");
});
closeConfirmation.addEventListener("click", function () {
	confirmationMessageBox.classList.remove("show");
});

kickButton.addEventListener("click", function () {
	reasonMessageBox.classList.add("show");
});
banButton.addEventListener("click", function () {
	reasonMessageBox.classList.add("show");
});
exitButton.addEventListener("click", function () {
	reasonMessageBox.classList.remove("show");
});
const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			reasonMessageBox.classList.remove("show");
			break;
	}
	console.log(e.key); // Allow to see what key bind is selected!
};

window.addEventListener("keydown", handleMovement);