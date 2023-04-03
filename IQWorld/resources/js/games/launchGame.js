import { RabbitGame } from "./RabbitDance/game.js"
import { SpeedCalculGame } from "./SpeedCalcul/game.js"

import $ from 'jquery';

const idMeta = document.querySelector('meta[id]');
const idUser = idMeta.getAttribute('id'); // Récupération de l'id utilisateur
idMeta.remove(); // Suppression de la balise meta à des fins de sécurité

const gameMeta = document.querySelector('meta[game]');
const idGame = gameMeta.getAttribute('game'); // Récupération de l'id du jeu
gameMeta.remove(); // Suppression de la balise meta à des fins de sécurité

var myButton = document.getElementById("buttonPlay"); // Récupération du bouton play
var gameDiv = document.getElementById("game"); // Récupération de la div de jeu

// Variables qui seront ajoutées à la base de données à la fin du jeu
let playerDataPoints = undefined;
let playerDataAccuracy = undefined;
let playerDataReactionTime = undefined;
let canUpdate = undefined;

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

function addPlayerData(updateRank) {
  $.ajax({
      url: '/api/user/' + idUser + "/" + idGame,
      type: 'POST',
      data: {
        points: playerDataPoints,
        accuracy: playerDataAccuracy,
        reaction_time: playerDataReactionTime,
        rank_up: updateRank,
        created_date: getCurrentDateTime()
      },
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
          canUpdate = data['can_update'];
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
      return new SpeedCalculGame(gameDiv, playerRank(playerDataPoints));
    case 3:
      return new RabbitGame(gameDiv, playerRank(playerDataPoints));
    case 4:
      return new AttenTouchGame(gameDiv, playerRank(playerDataPoints));
    default:
      return undefined;
  }
}

function startGame() {
  let game = chooseGame();
  //Lancement du jeu
  let intervalId = setInterval(function() {
      if (!game.endGame) {
          game.play();
      } else {
          showEndGame(game);
          clearInterval(intervalId);
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
function showEndGame(game)
{
  deleteAllChildren();

  // Détecte si connecté
  if(idUser != '')
  {
    // Si les points du joueur sont supérieurs à son score max
    if (game.playerPoints > playerDataPoints) 
    {
      playerDataPoints = game.playerPoints ? game.playerPoints : null;
      playerDataAccuracy = game.playerAccuracy ? game.playerAccuracy : null;
      playerDataReactionTime = game.playerReactionTime ? game.playerReactionTime : null;

      if(canUpdate)
      {
        createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "Congratulation ! You're leveling up !");
        addPlayerData(1);
      }
      else
      {
        createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "You have already moved up a rank, or your score is too low to move up.");
        addPlayerData(0);
      }
    }
    // Si les points du joueur ne sont pas supérieurs à son score max
    else 
    {
      createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "Too bad... You'll do better next time");
      addPlayerData(0);
    }
  }
  // S'il n'est pas connecté
  else
  {
    createParagraph("instructions", "color: white; font-size: 40%; text-align: center", "You must be registered for your score to be saved");
  }

    createParagraph("instructions", "color: white; font-size: 60%; text-align: center", "Your score : " + game.playerPoints + "pts");
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

//Date du jour
function getCurrentDateTime() {
  let date = new Date();
  let year = date.getFullYear();
  let month = (date.getMonth() + 1).toString().padStart(2, '0');
  let day = date.getDate().toString().padStart(2, '0');
  let hours = date.getHours().toString().padStart(2, '0');
  let minutes = date.getMinutes().toString().padStart(2, '0');
  let seconds = date.getSeconds().toString().padStart(2, '0');
  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
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


