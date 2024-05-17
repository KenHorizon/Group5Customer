function openNoticeBox() {
	reasonMessageBox.classList.add("show");
}
function openConfigBox(email) {
	let accountSync = document.getElementById("getSelectedAccount");
	accountSync.value = email;
	configOptionBox.classList.add("show");
}
function exitButtons(target) {
	target.classList.remove("show");
}
