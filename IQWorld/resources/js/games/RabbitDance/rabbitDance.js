import { Game } from './game.js';

var canvas = document.getElementById("canvasGames");
var ctx = canvas.getContext("2d");

let game = new Game();
game.createRabbits(canvas);
game.play(ctx, canvas);