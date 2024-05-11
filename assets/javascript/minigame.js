

const handleMovement = (e) => {
    switch (e.key) {
        case 'a':
            myGamePiece.speedX = -1; 
            break;  
        case 'd':
            myGamePiece.speedX = 1;
            break;
        case 'w':
            myGamePiece.speedY = -1; 
            break;
        case 's':
            myGamePiece.speedY = 1;
            break;
        case ' ':
            myGamePiece.speedY = 0;
            myGamePiece.speedX = 0;
            break;
        case 'Shift':
            myGamePiece.speedX *= 1.1;
            break;
    }
    console.log(e.key);
}
window.addEventListener('keydown', handleMovement)
var myGamePiece;

function startGame() {
    myGamePiece = new component(30, 30, "red", 10, 120);
    myGameArea.start();
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = window.innerWidth;;
        this.canvas.height = window.innerHeight;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.interval = setInterval(updateGameArea, 20);
    },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}

function component(width, height, color, x, y) {
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;
    this.x = x;
    this.y = y;    
    this.update = function() {
        ctx = myGameArea.context;
        ctx.fillStyle = color;
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
    this.newPos = function() {
        this.x += this.speedX;
        this.y += this.speedY;        
    }    
}

function updateGameArea() {
    myGameArea.clear();
    myGamePiece.newPos();    
    myGamePiece.update();
}