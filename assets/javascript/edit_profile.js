import {
	messageBox,
	getData,
	removeData,
	saveData,
} from "./function.js";


// DATABASE

//
messageBox(editProfilePopup);

profilePictureEdit.addEventListener("click", function () {
	editProfilePopup.classList.add("show");
});
exitButton.addEventListener("click", function () {
	editProfilePopup.classList.remove("show");
});
const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			editProfilePopup.classList.remove("show");
			break;
	}
	console.log(e.key); // Allow to see what key bind is selected!
};

window.addEventListener("keydown", handleMovement);
