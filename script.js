const {body} = document;
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const gameOverEl = document.createElement('div');
const canvasHeight = window.innerHeight*0.86;
const canvasWidth = window.innerWidth*0.29;

//ball
let ballX = canvasWidth/2;
let ballY = canvasHeight/2;
const ballR = 5;
//Paddles
const paddleHeight = 10;
const paddleWidth = 70;
let paddleTopX = canvasWidth/2 - paddleWidth/2;
let paddleBotX = canvasWidth/2 - paddleWidth/2;
let playerMoved = false;
let playerScored = false;

//Speed
let ballSpeed;
let speedY;
let speedX = 0;
let trajectory;
let speedRate;
let computerSpeed;
//Score
let playerScore = 0;
let computerScore = 0;
let gameOver = true;
let newGame = true;

function makeCanvas(){
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;
    context.fillStyle = 'black';
    //TopPaddle
    context.fillRect(paddleTopX,0,paddleWidth,paddleHeight);
    //BotPaddle
    context.fillRect(paddleBotX,canvasHeight,paddleWidth,-paddleHeight);
    //Middle Line
    context.beginPath();
    context.moveTo(0,canvasHeight/2);
    context.lineTo(canvasWidth,canvasHeight/2);
    context.stroke();
    //Ball
    context.beginPath();
    context.arc(ballX,ballY,ballR,2*Math.PI,false);
    context.fill();
    //Score
    context.font = '30px Times New Roman';
    context.fillText(playerScore, 20, canvas.height / 2 + 50);
    context.fillText(computerScore, 20, canvas.height / 2 - 30);

}

function ballReset() {
    ballX = canvasWidth / 2;
    ballY = canvasHeight / 2;
    speedX = 0;
    paddleTopX =canvasWidth/2 - paddleWidth/2;
  }

function ballMove() {
    ballY += speedY;
    ballX += speedX;

  }

  function ballBoundaries() {
    //Left Wall
    if (ballX < 0 && speedX < 0) {
      speedX = -speedX;
    }
    //Right Wall
    if (ballX > canvasWidth && speedX > 0) {
      speedX = -speedX;
    }
    //Bot Wall
    if(ballY > canvasHeight){
      playerScored = false;
      computerScore++;
      ballReset();
    }
    //Top Wall
    if(ballY<0){
      playerScored = true;
      playerScore++;
      speedY = -speedY;
      ballReset();
    }
    // BotPaddle
    if (ballY > canvasHeight - paddleHeight-ballR && ballX > paddleBotX && ballX < paddleBotX + paddleWidth) {
        speedY = -speedY;
        trajectory = ballX - (paddleBotX + paddleWidth/2);
        speedX = trajectory * speedRate;

    }

    //TopPaddle
    if (ballY < paddleHeight/2 + ballR && ballX > paddleTopX && ballX < paddleTopX + paddleWidth) {
        speedY = -speedY;
    }

    //Computer Movement
    if(paddleTopX + paddleWidth/2 != ballX){
      if(paddleTopX + paddleWidth/2 < ballX)
        paddleTopX += computerSpeed;
      else
        paddleTopX -= computerSpeed;
      }
}

function gameOverScreen(){
  if(playerScore == 7 || computerScore == 7){
    gameOver = true;
    let text;
    if(playerScore == 7)
      text = 'You won!';
    if(computerScore == 7)
      text = 'Computer won!';
  
  canvas.hidden = true;

  gameOverEl.textContent = '';
  gameOverEl.classList.add('game-over-container');

  const title = document.createElement('h1');
  title.textContent = text;

  const playAgainBtn = document.createElement('button');
  playAgainBtn.classList.add('play_button');
  playAgainBtn.setAttribute('onclick', 'game(computerSpeed, ballSpeed)');
  playAgainBtn.textContent = 'Play again';

  const newGameBtn = document.createElement('button');
  newGameBtn.classList.add('play_button');
  newGameBtn.setAttribute('onclick', "location.href='index.php'");
  newGameBtn.textContent = 'Change parameters';

  gameOverEl.append(title, playAgainBtn, newGameBtn);
  body.appendChild(gameOverEl);
  }
}

function animate(){
  makeCanvas();
  ballMove();
  ballBoundaries();
  gameOverScreen();
  if(!gameOver)
    window.requestAnimationFrame(animate);
}

function game(compSpeed, bSpeed){
  ballSpeed = parseInt(bSpeed);
  computerSpeed =parseInt(compSpeed);

  switch (ballSpeed) {
    case 1:
      speedY = 2;
      speedRate = 0.2
      break;
    case 2:
      speedY = 3;
      speedRate = 0.3;
      break;
    case 3:
      speedY = 4;
      speedRate = 0.4;
      break;
    case 4:
      speedY = 5;
      speedRate = 0.5;
      break;
    case 5:
      speedY = 6;
      speedRate = 0.6;
      break;
    case 6:
      speedY = 7;
      speedRate = 0.7;
      break;
    default:
      speedY = 3;
      speedRate = 0.3;
      break;
  }


  canvas.hidden = false;
  if (gameOver && !newGame) {
    body.removeChild(gameOverEl);
    canvas.hidden = false;
  }
  gameOver = false;
  newGame = false;
  playerScore = 0;
  computerScore = 0;
  ballReset();
  makeCanvas();
  animate();
  addEventListener('mousemove', (e) =>{
        playerMoved = true;
        paddleBotX = e.clientX - window.screen.width/2 + canvasWidth/2 - paddleWidth/2;
        if (paddleBotX < paddleWidth/2) {
            paddleBotX = 0;
        }
        if (paddleBotX > canvasWidth - paddleWidth/2) {
            paddleBotX = canvasWidth - paddleWidth;
        }
        //canvas.style.cursor = 'none';
    })
}


