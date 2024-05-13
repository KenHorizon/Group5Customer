function worldClock() {
	const time = new Date();
	let hours = time.getHours();
	const meridiem = hours >= 12 ? "PM" : "AM";
	hours = hours % 12 || 12;
	hours = hours.toString().padStart(2, 0);
	const minutes = time.getMinutes().toString().padStart(2, 0);
	const seconds = time.getSeconds().toString().padStart(2, 0);
	const worldTime = `${hours}:${minutes}:${seconds} ${meridiem}`;
	document.getElementById("clock").textContent = worldTime;
}
worldClock();
setInterval(worldClock, 1000);