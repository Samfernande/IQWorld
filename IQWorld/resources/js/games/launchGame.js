import { startGame } from './RabbitDance/rabbitDance.js';


var myButton = document.getElementById("buttonPlay");

let buttonClick = function()
{
  scrollToElement();
  changeBackground()
  removeButton(myButton);
  myButton.removeEventListener("click", buttonClick)
  startGame();
}

myButton.addEventListener("click", buttonClick);


function scrollToElement() 
{
    var element = document.getElementById('canvasGames');
    element.scrollIntoView({behavior: 'smooth'}); 
}

function changeBackground() {
  var background = document.getElementById("background");
  background.classList.remove(background.classList[0]);
  background.style.backgroundColor = "#1E1D1D";
  background.style.transition = "background-color 0.5s ease-in-out";
}

function removeButton(button)
{

var opacity = 1;
var intervalID = setInterval(function() {
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

