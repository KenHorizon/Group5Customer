
// PROFILE PICTURElet profilePicture = document.getElementById("profilePicture"); // Image
let inputFile = document.getElementById("profilePictureInput"); // Get source file of selected files in #input.file ("profilePictureInput") at "account.php"

// END
// Profile picture Script
inputFile.onchange = function () {
	profilePictureReview.src = URL.createObjectURL(inputFile.files[0]);
	console.log("Input Fils Passed!");
	console.log(profilePicture.src);
};
