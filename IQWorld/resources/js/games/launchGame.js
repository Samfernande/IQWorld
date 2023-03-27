import { Game } from "./RabbitDance/game.js"

var myButton = document.getElementById("buttonPlay");
var gameDiv = document.getElementById("game");

// Actions quand le bouton a été cliqué
let buttonClick = function()
{
  scrollToElement();
  changeBackground()
  removeButton(myButton);
  myButton.removeEventListener("click", buttonClick)
  countdown();
}

function startGame()
{
  let game = new Game(gameDiv);
  //Lancement du jeu
  setInterval(function() {
    game.play();
  }, 10);
}

myButton.addEventListener("click", buttonClick);

function countdown() {
  let count = 3;
  let gameDiv = document.getElementById('game');
  let countdownText = document.createElement('p');
  let countdownSound = new Audio('/storage/static/sounds/games/countDownSound.wav');

  gameDiv.appendChild(countdownText);
  countdownText.addEventListener('animationend', () => {
    countdownText.style.animation = '';
});

  let countdownInterval = setInterval(() => {

      if (count >= 0) {

          countdownSound.play();
          countdownText.textContent = count;
          countdownText.style.animation = 'growAndRotate 0.99s';
          count--;
      } else {
          clearInterval(countdownInterval);
          gameDiv.removeChild(countdownText);
          startGame();
      }
  }, 1000);
}

// Scroll jusqu'à la div game
function scrollToElement() 
{
    var element = document.getElementById('game');
    element.scrollIntoView({behavior: 'smooth', block: 'center'}); 
}

// Change la couleur du background
function changeBackground() {
  var background = document.getElementsByClassName("backgroundGame");
Array.from(background).forEach(element => {
  element.classList.remove(element.classList[0]);
  element.style.backgroundColor = "#1E1D1D";
  element.style.transition = "background-color 0.5s ease-in-out";
});
  
}

// Retire le bouton 
function removeButton(button)
{

  var opacity = 1;
  var intervalID = setInterval(function() 
  {

    if (opacity > 0) 
    {
      opacity -= 0.01;
      button.style.opacity = opacity;
    } 
    else 
    {
      clearInterval(intervalID);
      button.style.display = "none";
    }
  }, 10);
}


