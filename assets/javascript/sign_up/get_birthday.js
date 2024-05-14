const inputNumberCheckDay = document.getElementById("checkNumberOnDay");
const inputNumberCheckYear = document.getElementById("checkNumberOnYear");

inputNumberCheckDay.addEventListener("click", function () {
	let max = Number(inputNumberCheckDay.max);
	let value = Number(inputNumberCheckDay.value);
	// console.log(max + " - " + value);
	// console.log(value > max);

	if (value > max) {
		inputNumberCheckDay.value = max;
	}
});

inputNumberCheckYear.addEventListener("click", function () {
	let max = Number(inputNumberCheckYear.max);
	let value = Number(inputNumberCheckYear.value);
	if (value > max) {
		inputNumberCheckYear.value = max;
	}
	// console.log(max + " - " + value);
	// console.log(value > max);
});
windowClick(inputNumberCheckDay);
windowClick(inputNumberCheckYear);

function windowClick(name) {
	window.addEventListener("click", function (event) {
		let max = Number(name.max);
		let value = Number(name.value);
		if (value > max) {
			name.value = max;
		}
	});
}
