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
        for (var i = 0; i < this.rand(0, 3); i++)
        {
            this.rabbitsLeft.push(new Rabbit(this.rand(0, 4), this.rand(0, 10), this.rand(0, 10), this.rand(1, 5), this.rand(1, 5), this.rand(100, 150)));
        }

        for (var i = 0; i < this.rand(0, 3); i++)
        {
            this.rabbitsRight.push(new Rabbit(this.rand(0, 4), this.rand(canvas.width - 10, canvas.width), this.rand(canvas.height - 10, canvas.height), this.rand(-1, -5), this.rand(-1, -5), this.rand(100, 150)));
        }
    }

    drawRabbits(ctx, canvas)
    {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
      
        this.rabbitsLeft.forEach(rabbit => {
          rabbit.draw(ctx, canvas);
        });

        this.rabbitsRight.forEach(rabbit => {
          rabbit.draw(ctx, canvas);
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