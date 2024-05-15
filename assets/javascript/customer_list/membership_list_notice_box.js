function openNoticeBox() {
	reasonMessageBox.classList.add("show");
	confirmButton.addEventListener("click", function () {
		confirmationMessageBox.classList.add("show");
	});
	closeConfirmation.addEventListener("click", function () {
		confirmationMessageBox.classList.remove("show");
	});
	exitButton.addEventListener("click", function () {
		reasonMessageBox.classList.remove("show");
	});
}