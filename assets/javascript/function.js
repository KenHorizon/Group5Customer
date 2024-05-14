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
			showInformation(subscriptionBasic, true);
			showInformation(basicSubscriptionYear, true);
			showInformation(basicSubscriptionMonth, false);
			basicSubscriptionYearCheck.checked = true;
			basicSubscriptionMonthCheck.checked = false;
		});
	} else {
		name.addEventListener("click", function () {
			showInformation(subscriptionAdvance, true);
			showInformation(advanceSubscriptionYear, true);
			showInformation(advanceSubscriptionMonth, false);
			advanceSubscriptionYearCheck.checked = true;
			advanceSubscriptionMonthCheck.checked = false;
		});
	}
	//console.log(name.id);
}
export function seconds(seconds) {
	return seconds * 1000;
}
export function showInformation(name = null, boolean = null, type = null) {
	if (boolean === true || boolean === null) {
		if (name.classList.contains("hide")) {
			name.classList.remove("hide");
			name.classList.add("show");
		} else {
			if (type === null) {
				name.classList.add("show");
			} else {
				name.classList.add(type);
			}
		}
	} else {
		if (name.classList.contains("hide")) {
			name.classList.add("hide");
		} else {
			if (type === null) {
				name.classList.remove("show");
				name.classList.add("hide");
			} else {
				name.classList.remove(type);
			}
		}
	}
}
export function exitOnClicked(classId = null) {
	window.addEventListener("click", function (event) {
		if (classId == event.target) {
			classId.classList.remove("show");
		}
	});
}
