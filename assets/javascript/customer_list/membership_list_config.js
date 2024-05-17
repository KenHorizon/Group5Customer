function openNoticeBox(email) {
	let accountSync = document.getElementById("getSelectedAccount");
	accountSync.value = email;
	configOptionBox.classList.add("show");

	confirmButton.addEventListener("click", function () {
		confirmationMessageBox.classList.add("show");
	});
	closeConfirmation.addEventListener("click", function () {
		confirmationMessageBox.classList.remove("show");
	});
}
exitButtons.addEventListener("click", function () {
	configOptionBox.classList.remove("show");
});
