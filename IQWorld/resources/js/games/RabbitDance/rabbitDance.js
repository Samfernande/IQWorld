import { Game } from './game.js';

// Récupération du jeu
let game = new Game();

// Variable définissant si le jeu a commencé ou non
let gameStart = false;


// Méthode de lancement du jeu (PRINCIPALE)
export function startGame()
{
    setInterval(timerGame, 10);
}

// Méthode boucle du jeu
function timerGame()
{
        if(!gameStart)
        {
            game.createRabbits();
            setInterval(playGame, 10);
            gameStart = true;
        }
        
}

function playGame()
{
    game.play();
}
