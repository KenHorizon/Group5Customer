// Function
export default class Data {
	constructor(dataName, dataValue) {
		this.dataName = dataName;
		this.dataValue = dataValue;
	}
}

export function saveData(dataName, dataValue) {
	if (typeof Storage !== "undefined") {
		localStorage.setItem(dataName, dataValue);
		console.log("Data has been saved");
	}
}
export function removeData(dataName) {
	if (typeof Storage !== "undefined") {
		localStorage.removeItem(dataName);
		console.log("Data has been removed");
	}
}
export function getData(dataName) {
	console.log("Data has been get");
	return localStorage.getItem(dataName);
}

export function messageBox(name) {
	window.addEventListener("click", function (event) {
		if (event.target == name) {
			name.classList.remove("show");
		}
	});
}

export function subscriptionButton(name) {
	if (name.id == "basicSubscriptionButton") {
		name.addEventListener("click", function () {
			subscriptionBasic.classList.add("show");
			basicSubscriptionYear.classList.add("show");
			basicSubscriptionMonth.classList.remove("show");
			basicSubscriptionYearCheck.checked = true;
			basicSubscriptionMonthCheck.checked = false;
		});
	} else {
		name.addEventListener("click", function () {
			subscriptionAdvance.classList.add("show");
			advanceSubscriptionYear.classList.add("show");
			advanceSubscriptionMonth.classList.remove("show");
			advanceSubscriptionYearCheck.checked = true;
			advanceSubscriptionMonthCheck.checked = false;
		});
	}
	//console.log(name.id);
}
export function seconds(seconds) {
	return seconds * 1000;
}
