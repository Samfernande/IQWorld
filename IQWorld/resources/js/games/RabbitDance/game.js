import { Rabbit } from './rabbit.js';
import { Interface } from './interface.js';

export class Game 
{

    constructor() {
        this.rabbitsLeft = [];
        this.rabbitsRight = [];

        // Récupération de l'interface
        this.interfaceGame = new Interface();

        // Récupération du canvas
        this.canvas = document.getElementById("canvasGames");
        this.ctx = this.canvas.getContext("2d");
    }

    rand(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }

    createRabbits()
    {
        for (var i = 0; i < this.rand(1, 3); i++)
        {
            this.rabbitsLeft.push(new Rabbit(this.rand(0, 4), this.rand(0, 10), this.rand(0, 10), this.rand(1, 5), this.rand(1, 5), this.rand(100, 150)));
        }

        for (var i = 0; i < this.rand(1, 3); i++)
        {
            this.rabbitsRight.push(new Rabbit(this.rand(0, 4), this.rand(this.canvas.width - 10, this.canvas.width), this.rand(this.canvas.height - 10, this.canvas.height), this.rand(-1, -5), this.rand(-1, -5), this.rand(100, 150)));
        }
    }

    drawRabbits()
    {
      
        this.rabbitsLeft.forEach(rabbit => {
          rabbit.draw(this.ctx, this.canvas);
        });

        this.rabbitsRight.forEach(rabbit => {
          rabbit.draw(this.ctx, this.canvas);
        });
    }

    updateRabbits()
    {
        this.rabbitsLeft.forEach(rabbit => {
            rabbit.update(this.ctx);
          });
        
          this.rabbitsRight.forEach(rabbit => {
            rabbit.update(this.ctx);
          });
    }

    drawInterface()
    {

    }

    play()
    {
        //Refresh le canvas
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.drawRabbits();
        this.updateRabbits();
    }
}