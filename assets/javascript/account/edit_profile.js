import { exitOnClicked, showInformation } from "../function.js";

exitOnClicked(editProfilePopup);

let profilePictureEdit = document.getElementById("profilePictureEdit");
let exitButton = document.getElementById("exitButton");

profilePictureEdit.addEventListener("click", function () {
	showInformation(editProfilePopup, true);
});
exitButton.addEventListener("click", function () {
	showInformation(editProfilePopup, false);
});
const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			showInformation(editProfilePopup, false);
			break;
	}
	console.log(e.key); // Allow to see what key bind is selected!
};

window.addEventListener("keydown", handleMovement);
