import { Rabbit } from './rabbit.js';
import { Interface } from './interface.js';
import { Timer } from './timer.js';


export class Game 
{

    constructor() {
        this.rabbitsLeft = [];
        this.rabbitsRight = [];

        // Récupération de l'interface
        this.interfaceGame = new Interface();
        this.countGame = new Timer();

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
        this.interfaceGame.drawInterface(this.canvas, this.ctx, 'Yolo', '3', 0, 0, this.canvas.width, 60, 'black');
        this.interfaceGame.drawInterface(this.canvas, this.ctx, 'Yolo', '3', 0, this.canvas.height-60, this.canvas.width, 60, 'black');
        // Texte informations
        this.interfaceGame.drawText("Yolo", '15px Fredoka', 'white', this.canvas.width / 2, 20, this.ctx);

        // Texte timer
        this.interfaceGame.drawText("5", '30px Fredoka', 'white', this.canvas.width / 2, this.canvas.height-30, this.ctx);
    }

    countDown(seconds)
    {
      seconds--;

      if(seconds == 0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }

    // Pourquoi async ?
    async play()
    {
        //Refresh le canvas
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.drawRabbits();
        this.updateRabbits();
        this.drawInterface();

        // Pourquoi await ?
        if(await this.countGame.playTimer(1000, 3))
        {
          console.log('YES');
        }
    }
}