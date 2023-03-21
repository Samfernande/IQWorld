export class Rabbit {
  
  constructor(color, posX, posY, speedX, speedY, size) {
  
      this.color = color;
      this.posX = posX;
      this.posY = posY;
      this.speedX = speedX;
      this.speedY = speedY;
      this.size = size;
      this.img = new Image();
      this.sprites = ['/storage/static/gamesImage/RabbitDance/rabbits/rabbit1.png',
                      '/storage/static/gamesImage/RabbitDance/rabbits/rabbit2.png']
  
      this.img.src = "/storage/static/gamesImage/RabbitDance/rabbits/rabbit1.png";
  }
  
  draw(ctx)
  {
      this.animation(1000);
      ctx.drawImage(this.img,this.posX,this.posY,this.size,this.size);
  }
  
  update(ctx)
  {
    this.posX += this.speedX;
    this.posY += this.speedY;
    
  }

  animation(miliseconds)
  {
    let count = 0;

    let interval = setInterval(function() 
    {

      if (typeof this.sprites[count] === undefined) {
        count = 0;
      }

      this.img.src = this.sprites[count];
      count++;

    }, miliseconds);
  }

  
}