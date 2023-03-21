import { Rabbit } from './rabbit.js';

export class Game 
{

    constructor() {
        this.rabbitsLeft = [];
        this.rabbitsRight = [];
    }

    rand(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }

    createRabbits(canvas)
    {
        for (var i = 0; i < this.rand(2, 6); i++)
        {
            this.rabbitsLeft.push(new Rabbit("white", this.rand(0, 100), this.rand(0, 100), this.rand(0.5, 3), this.rand(0.5, 3), this.rand(40, 60)));
        }

        for (var i = 0; i < this.rand(2, 6); i++)
        {
            this.rabbitsRight.push(new Rabbit("white", this.rand(canvas.width - 100, canvas.width), this.rand(canvas.height - 100, canvas.height), this.rand(-0.5, -3), this.rand(-0.5, -3), this.rand(40, 60)));
          
        }
    }

    drawRabbits(ctx, canvas)
    {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
      
        this.rabbitsLeft.forEach(rabbit => {
          rabbit.draw(ctx);
        });
      
        this.rabbitsRight.forEach(rabbit => {
          rabbit.draw(ctx);
        });
    }

    updateRabbits(ctx)
    {
        this.rabbitsLeft.forEach(rabbit => {
            rabbit.update(ctx);
          });
        
          this.rabbitsRight.forEach(rabbit => {
            rabbit.update(ctx);
          });
    }

    play(ctx, canvas)
    {
        this.drawRabbits(ctx, canvas);
        this.updateRabbits(ctx);
        requestAnimationFrame(() => this.play(ctx ,canvas));

    }
}