const myCanvas = document.getElementById('myCanvas');
myCanvas.width = window.innerWidth;
myCanvas.height = window.innerHeight;
myCanvas.style.backgroundColor = 'black';
myCanvas.style.margin = 0;
const ctx = myCanvas.getContext('2d');

const ball = {
    pos: {
        x: myCanvas.width / 2,
        y: myCanvas.height / 2 + 30
    },
    speedX: 3,
    speedY: 0.3,
    speedXModifier: 0.5,
    speedYModifier: 0.2,
    maxSpeedX: 10,
    maxSpeedY: 4,
    radius: 10,
    color: 'white'
};

const racket = {
    height: 130,
    width: 10,
    pos: {
        x: 25,
        y: myCanvas.height / 2 - 45
    },
    color: 'white',
    movingUp: false,
    movingDown: false,
    speed: 2,
    handicap: true
};

const racketEnemy = {
    height: 130,
    width: 10,
    pos: {
        x: myCanvas.width - 25 - 10,
        y: myCanvas.height / 2 - 45
    },
    color: 'white',
    movingUp: false,
    movingDown: false,
    speed: 2,
    handicap: true
};

const score = {
    player: 0,
    cpu: 0
};

var gameMessage = "READY?";
var restart = false;
var gameIsPaused = true;
document.onkeydown = getKeyDown;
document.onkeyup = getKeyUp;
setInterval(renderGame, 1);
var scoreSound = new Audio('courses/3_pong/sounds/ponto.mp3');
var racketHitSound = new Audio('courses/3_pong/sounds/raquetada.mp3');

function renderGame () {
    if (gameIsPaused === false) {
        if (restart) restartGame();
        clearScreen();
        drawArena();
        drawScore();
        moveBall();
        movePlayerRacket();
        moveEnemyRacket();
        collisionDetect();
        drawRacket(racket.pos.x, racket.pos.y, racket.width, racket.height, racket.color);
        drawRacket(racketEnemy.pos.x, racketEnemy.pos.y, racketEnemy.width, racketEnemy.height, racketEnemy.color);
        drawBall(ball.pos.x, ball.pos.y, ball.radius, ball.color);
        if ( score.player > 5 && racket.handicap === true ) {
            racket.height = racket.height / 2;
            racket.handicap = false;
        } else if ( score.cpu > 5 && racketEnemy.handicap === true ) {
            racketEnemy.height = racketEnemy.height / 2;
            racketEnemy.handicap = false;
        }
    } else {
        clearScreen();
        drawArena();
        drawScore();
        drawRacket(racket.pos.x, racket.pos.y, racket.width, racket.height, racket.color);
        drawRacket(racketEnemy.pos.x, racketEnemy.pos.y, racketEnemy.width, racketEnemy.height, racketEnemy.color);
        drawBall(ball.pos.x, ball.pos.y, ball.radius, ball.color);
        showPauseMsg(gameMessage);
    }
}

function drawBall (x, y, radius, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, radius, 0, 2 * Math.PI);
    ctx.fill();
}

function drawRacket (x, y, width, height, color) {
    ctx.fillStyle = color;
    ctx.fillRect(x, y, width, height);
}

function clearScreen () {
    ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
}

function collisionDetect () {
    //X axis wall collision:
    if (ball.pos.x - ball.radius < 0 ) {
        ball.speedX *= -1;
        increaseScore('cpu');
        restartMatch(-3);
    }
    if ( ball.pos.x + ball.radius > myCanvas.width) {
        ball.speedX *= -1;
        increaseScore('player');
        restartMatch(3);
    }
    //Y axis wall collision:
    if (ball.pos.y - ball.radius < 60 ||
        ball.pos.y + ball.radius > myCanvas.height) {
        ball.speedY *= -1;
    }
    //Player racket collision:
    if (ball.pos.x - ball.radius > racket.pos.x &&
        ball.pos.x - ball.radius < racket.pos.x + racket.width &&
        ball.pos.y + ball.radius > racket.pos.y &&
        ball.pos.y - ball.radius < racket.pos.y + racket.height ||
        ball.pos.x + ball.radius > racket.pos.x &&
        ball.pos.x + ball.radius < racket.pos.x + racket.width &&
        ball.pos.y + ball.radius > racket.pos.y &&
        ball.pos.y - ball.radius < racket.pos.y + racket.height) {
        ball.speedX *= -1;
        playRacketHitSound();
        if ( ball.speedX > - ball.maxSpeedX && ball.speedX < ball.maxSpeedX ) {
            ball.speedX += ball.speedXModifier;
            console.log('X: ' + ball.speedX);
        }
        if ( ball.speedY > -ball.maxSpeedY && ball.speedY < ball.maxSpeedY ) {
            if (ball.speedY < 0) {
                ball.speedY -= ball.speedYModifier;
                console.log('Y: ' + ball.speedY);
            } else {
                ball.speedY += ball.speedYModifier;
                console.log('Y: ' + ball.speedY);
            }
        }
    }
    //Enemy racket collision:
    if (ball.pos.x + ball.radius > racketEnemy.pos.x &&
        ball.pos.x + ball.radius < racketEnemy.pos.x + racketEnemy.width &&
        ball.pos.y + ball.radius > racketEnemy.pos.y &&
        ball.pos.y - ball.radius < racketEnemy.pos.y + racketEnemy.height ||
        ball.pos.x + ball.radius > racketEnemy.pos.x &&
        ball.pos.x + ball.radius < racketEnemy.pos.x + racketEnemy.width &&
        ball.pos.y + ball.radius > racketEnemy.pos.y &&
        ball.pos.y - ball.radius < racketEnemy.pos.y + racketEnemy.height) {
        ball.speedX *= -1;
        playRacketHitSound();
        if ( ball.speedX > -ball.maxSpeedX && ball.speedX < ball.maxSpeedX ) {
            ball.speedX -= ball.speedXModifier;
            console.log('X: ' + ball.speedX);
        }
        if ( ball.speedY > -ball.maxSpeedY && ball.speedY < ball.maxSpeedY ) {
            if (ball.speedY < 0) {
                ball.speedY -= ball.speedYModifier;
                console.log('Y: ' + ball.speedY);
            } else {
                ball.speedY += ball.speedYModifier;
                console.log('Y: ' + ball.speedY);
            }
        }
    }
}

function moveBall () {
    ball.pos.x += ball.speedX;
    ball.pos.y += ball.speedY;
}

function getKeyDown (event) {
    var keyCode = event.keyCode;
    switch (keyCode) {
        case 38:
        racketEnemy.movingUp = true;
        gameIsPaused = false;
        break;
        case 40:
        racketEnemy.movingDown = true;
        gameIsPaused = false;
        break;
        case 87:
        racket.movingUp = true;
        gameIsPaused = false;
        break;
        case 83:
        racket.movingDown = true;
        gameIsPaused = false;
        break;
        case 82:
        if (gameIsPaused === false) {
            restart = true;
        }
        break;
        case 80:
        if (gameIsPaused === true) {
            gameMessage = 'READY?';
            gameIsPaused = false;
        } else {
            gameMessage = 'GAME PAUSED';
            gameIsPaused = true;
        }
        break;
    }
}

function getKeyUp (event) {
    var keyCode = event.keyCode;
    switch (keyCode) {
        case 38:
        racketEnemy.movingUp = false;
        break;
        case 40:
        racketEnemy.movingDown = false;
        break;
        case 87:
        racket.movingUp = false;
        break;
        case 83:
        racket.movingDown = false;
        break;
    }
}

function movePlayerRacket () {
    if ( racket.movingUp && racket.pos.y > 60 ) {
         racket.pos.y -= racket.speed;
    }
    if ( racket.movingDown &&
        racket.pos.y + racket.height < myCanvas.height ) {
        racket.pos.y += racket.speed;
    }
}

function moveEnemyRacket () {
    if ( racketEnemy.movingUp && racketEnemy.pos.y > 60 ) {
         racketEnemy.pos.y -= racketEnemy.speed;
    }
    if ( racketEnemy.movingDown &&
        racketEnemy.pos.y + racketEnemy.height < myCanvas.height ) {
        racketEnemy.pos.y += racketEnemy.speed;
    }
}

function drawScore () {
    ctx.fillStyle = 'white';
    ctx.fillRect(10, 10, myCanvas.width - 20, 50);
    ctx.textAlign ='left';
    ctx.fillStyle = 'black';
    ctx.font = '40px monospace, Arial';
    ctx.fillText(score.player, 20, 49, 50);
    ctx.font = '50px monospace, Arial';
    ctx.fillText('-SCORE-', myCanvas.width / 2 - 99, 50);
    ctx.textAlign ='right';
    ctx.font = '40px monospace, Arial';
    ctx.fillText(score.cpu, myCanvas.width - 20, 49, 50);
}

function restartMatch (direction) {
    racket.pos.y = myCanvas.height / 2 - racket.height / 2 + 30;
    racketEnemy.pos.y = myCanvas.height / 2 - racketEnemy.height / 2 + 30;
    ball.pos.x = myCanvas.width / 2;
    ball.pos.y = myCanvas.height / 2 + 10;
    ball.speedX = direction;
    ball.speedY = 0.3;
    gameIsPaused = true;
    gameMessage = 'READY?';
    showPauseMsg(gameMessage);
}

function increaseScore (player) {
    if (player === 'player') score.player++;
    if (player === 'cpu') score.cpu++;
    playScoreSound();
}

function drawArena () {
    ctx.fillStyle = 'white';
    ctx.beginPath();
    ctx.arc(myCanvas.width / 2, myCanvas.height / 2 + 30, myCanvas.height / 5, 0, 2 * Math.PI);
    ctx.fill();
    ctx.beginPath();
    ctx.fillStyle = 'black';
    ctx.arc(myCanvas.width / 2, myCanvas.height / 2 + 30, myCanvas.height / 5.1, 0, 2 * Math.PI);
    ctx.fill();
    ctx.fillStyle = 'white';
    ctx.fillRect(myCanvas.width / 2 - 1, 60, 2, myCanvas.height);
}

function restartGame () {
    score.player = 0;
    score.cpu = 0;
    restartMatch(3);
    restart = false;
    racket.height = 130;
    racketEnemy.height = 130;
    racket.pos.y = myCanvas.height / 2 - racket.height / 2 + 30;
    racketEnemy.pos.y = myCanvas.height / 2 - racketEnemy.height / 2 + 30;
}

function playRacketHitSound () {
    racketHitSound.play();
}

function playScoreSound () {
   scoreSound.play();
}

function showPauseMsg (message) {
    ctx.globalAlpha = 0.005;
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, myCanvas.width, myCanvas.height);
    ctx.fillStyle = 'green';
    ctx.globalAlpha = 1;
    ctx.textAlign ='center';
    ctx.font = '80px monospace, Arial';
    ctx.fillText(message, myCanvas.width / 2, myCanvas.height / 2 + 40, 500);
    ctx.textAlign ='left';
}
