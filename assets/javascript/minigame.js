
const screenX = window.innerWidth;
const screenY = window.innerHeight;
const handleMovement = (e) => {
	if (e.key === "a") {
		myGamePiece.speedX = -1;
	}
	if (e.key === "d") {
		myGamePiece.speedX = 1;
	}
	if (e.key === "w") {
		myGamePiece.speedY = -1;
		if (myGamePiece.speedX > 0) {
			myGamePiece.speedX = 0;
		}
		if (myGamePiece.speedX < 0) {
			myGamePiece.speedX = 0;
		}
	}
	if (e.key === "s") {
		myGamePiece.speedY = 1;
		if (myGamePiece.speedX > 0) {
			myGamePiece.speedX = 0;
		}
		if (myGamePiece.speedX < 0) {
			myGamePiece.speedX = 0;
		}
	}
	if (e.key === " ") {
		myGamePiece.speedY = 0;
		myGamePiece.speedX = 0;
	}
	if (e.key === "Shift") {
		myGamePiece.speedX *= 1.2;
		myGamePiece.speedX *= 1.2;
	}
	//console.log(e.key);
};
window.addEventListener("keydown", handleMovement);
var myGamePiece;

function startGame() {
	myGamePiece = new component(30, 30, "white", screenX*0.5, screenY*0.5);
	myGameArea.start();
}

var myGameArea = {
	canvas: document.createElement("canvas"),
	start: function () {
        contextSizeX = 1000;
        contextSizeY = 500;
		this.canvas.width = contextSizeX;
		this.canvas.height = screenY * 0.5;
		this.context = this.canvas.getContext("2d");
        this.context.fill();
		this.context.strokeStyle = "red";
		document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.context.rect(contextSizeX, 0, this.canvas.width, this.canvas.height);
		this.interval = setInterval(updateGameArea, 20);
	},
	clear: function () {
		this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
	},
};

function component(width, height, color, x, y) {
	this.width = width;
	this.height = height;
	this.speedX = 0;
	this.speedY = 0;
	this.x = x;
	this.y = y;
	this.update = function () {
		ctx = myGameArea.context;
		ctx.fillStyle = color;
		ctx.fillRect(this.x, this.y, this.width, this.height);
		ctx.strokeStyle = "red";
        ctx.lineWidth = 10;
        ctx.stroke();
	};
	this.newPos = function () {
		this.x += this.speedX;
		this.y += this.speedY;
	};
}

function updateGameArea() {
	myGameArea.clear();
	myGamePiece.newPos();
	myGamePiece.update();
	console.log("Speed X:" + myGamePiece.speedX);
	console.log("Speed Y:" + myGamePiece.speedY);
}
