import { exitOnClicked } from "../function.js";

exitOnClicked(configOptionBox);
exitOnClicked(reasonMessageBox);

const handleMovement = (e) => {
	switch (e.key) {
		case "Escape":
			configOptionBox.classList.remove("show");
			reasonMessageBox.classList.remove("show");
			break;
	}
	console.log(e.key); // Allow to see what key bind is selected!
};
window.addEventListener("keydown", handleMovement);
