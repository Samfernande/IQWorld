import { RabbitGame } from "./RabbitDance/game.js"
import { AttenTouchGame } from "./AttenTouch/game.js"

import $ from 'jquery';

const idMeta = document.querySelector('meta[id]');
const idUser = idMeta.getAttribute('id'); // Récupération de l'id utilisateur
idMeta.remove(); // Suppression de la balise meta à des fins de sécurité

const gameMeta = document.querySelector('meta[game]');
const idGame = gameMeta.getAttribute('game'); // Récupération de l'id du jeu
gameMeta.remove(); // Suppression de la balise meta à des fins de sécurité

var myButton = document.getElementById("buttonPlay"); // Récupération du bouton play
var gameDiv = document.getElementById("game"); // Récupération de la div de jeu

let playerDataPoints = undefined;

// Rang du joueur
function playerRank(points)
{
  if(idUser == '')
  {
    return undefined;
  }
  else if(points == 0 || points == undefined)
  {
    return 0;
  }
  else if(points > 0 && points <= 1000)
  {
    return 1;
  }
  else if(points > 1000 && points <= 2000)
  {
    return 2;
  }
  else if(points > 2000 && points <= 4000)
  {
    return 3;
  }
  else if(points > 4000 && points <= 6000)
  {
    return 4;
  }
  else if(points > 6000 && points <= 8000)
  {
    return 5;
  }
  else if(points > 8000 && points <= 10000)
  {
    return 6;
  }
  else
  {
    return 7;
  }
}

function addPlayerData() {
  $.ajax({
      url: '/api/user/' + idUser + "/" + idGame,
      type: 'POST',
      data: {points: playerDataPoints},
      success: function(data) {
          console.log('Données ajoutées avec succès!');
      }
  });
}

// Récupération des données de la base de données

function getPlayerData() {
  $.ajax({
      url: '/api/user/' + idUser + "/" + idGame,
      type: 'GET',
      success: function(data) {
          playerDataPoints = data['points'];
      },
  });
}

if(idUser != '')
{
  getPlayerData();
}
// Actions quand le bouton a été cliqué
let buttonClick = function()
{
  scrollToElement();
  changeBackground()
  removeButton(myButton);
  myButton.removeEventListener("click", buttonClick)
  countdown();
}

// Méthode sélectionnant le bon jeu suivant l'id de la page
function chooseGame()
{
  switch (parseInt(idGame)) {

    case 1:
      return undefined;
    case 2:
      return undefined
    case 3:
      return new RabbitGame(gameDiv, playerRank(playerDataPoints));
    case 4:
      return new AttenTouchGame(gameDiv, playerRank(playerDataPoints));
    default:
      return undefined;
  }
}

function startGame()
{
  let game = chooseGame();
  //Lancement du jeu
  setInterval(function() {
    if(!game.endGame)
    {
      game.play();
    }
    else
    {
      showEndGame();
    }
  }, 10);
}

function deleteAllChildren() {
  while (gameDiv.firstChild) {
      gameDiv.removeChild(gameDiv.firstChild);
  }
}

function createParagraph(id, styles, content) {
  let p = document.createElement("p");
  p.id = id;
  p.style = styles;
  p.textContent = content;
  gameDiv.appendChild(p);
}

myButton.addEventListener("click", buttonClick);

// PROBLEME AVEC LES POINTS
function showEndGame()
{
  deleteAllChildren();

  if( idUser !== undefined && game.playerPoints > playerDataPoints)
      {
        deleteAllChildren();

        if (game.isLogging == false) 
        {
          createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "You must be registered for your score to be saved");
        }
        else 
        {
          createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "Your score has been saved");
        }
        playerDataPoints = game.playerPoints;
        addPlayerData();
      }
      else
      {
        createParagraph("instructions", "color: white; font-size: 60%; text-align: center", game.playerPoints + "pts");
        createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "You haven't broken your record! Your score has not been saved");
      }

      createParagraph("instructions", "color: white; font-size: 60%; text-align: center", game.playerPoints + "pts");

}

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


