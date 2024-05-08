let bioSaveButton = document.getElementById("bioSaveButton");
let bioEditButton = document.getElementById("bioEditButton");
let bioRemoveButton = document.getElementById("bioRemoveButton");
let profileBio = document.getElementById("profileBioDataText");
// PROFILE PICTURE
let profilePicture = document.getElementById("profilePicture"); // Image
let inputFile = document.getElementById("profilePictureInput"); // Get source file of selected files in #input.file ("profilePictureInput") at "account.php"
let removeInputFile = document.getElementById("profilePictureRemove"); // Remove button and set the profile to default/empty
let saveInputFile = document.getElementById("profilePictureSave"); // Save button, store data image
let editInputFile = document.getElementById("profilePictureEdit"); // Edit button allow to select files and input data to inputFile

// END
// Bio Description Script
bioSaveButton.addEventListener("click", function () {
	profileBio.disabled = true;
	bioEditButton.classList.remove("hide");
	if (typeof Storage !== "undefined") {
		localStorage.setItem("bioDescriptionData", profileBio.value);
	}
	bioSaveButton.classList.add("hide");
	console.log("Data Value: " + profileBio.value);
});
bioEditButton.addEventListener("click", function () {
	profileBio.disabled = false;
	console.log("Bio Edit has been clicked!");
});
bioRemoveButton.addEventListener("click", function () {
	profileBio.innerHTML = "";
	profileBio.value = "";
	profileBio.disabled = true;
	if (typeof Storage !== "undefined") {
		localStorage.setItem("bioDescriptionData", profileBio.value);
	}
	console.log("Bio Remove Button has been clicked!");
	console.log(
		localStorage.getItem("bioDescriptionData") + " :Has been removed"
	);
});
profileBio.addEventListener("click", function () {
	bioEditButton.classList.add("hide");
	document.getElementById("bioSaveButton").classList.remove("hide");
	console.log("The Text Area has been clicked!");
});
// END
// Profile picture Script
inputFile.onchange = function () {
	profilePicture.src = URL.createObjectURL(inputFile.files[0]);
	editInputFile.classList.add("hide");
	saveInputFile.classList.remove("hide");
};
saveInputFile.onclick = function () {
	editInputFile.classList.remove("hide");
	saveInputFile.classList.add("hide");
	profilePicture.classList.add("customPicture");
	const fileReader = new FileReader();
	fileReader.addEventListener("load", () => {
		// console.log(fileReader.result);
		if (typeof Storage !== "undefined") {
			localStorage.setItem("profilePictureData", fileReader.result);
		}
	});
	fileReader.readAsDataURL(inputFile.files[0]);
	console.log("Profile has been saved!");
};
editInputFile.onclick = function () {
	console.log("Edit button has been clicked!");
};
removeInputFile.onclick = function () {
	profilePicture.classList.remove("customPicture");
	if (typeof Storage !== "undefined") {
		localStorage.setItem("profilePictureData", "assets/img/default_pfp.jpeg");
	}
};

window.onload = function () {
	console.log("This page has been reloaded!");
	profileBio.innerHTML = localStorage.getItem("bioDescriptionData");
	if (profilePicture.classList.contains("customPicture") == "undefined") {
		if (typeof Storage !== "undefined") {
			localStorage.setItem("profilePictureData", "assets/img/default_pfp.jpeg");
		}
	} else {
		profilePicture.src = localStorage.getItem("profilePictureData");
	}
};