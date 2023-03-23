import { Soundizer } from "./audio";

export class Rabbit {
  
  constructor(color, posX, posY, speedX, speedY, size) {
  
    this.sound = new Soundizer();
    this.canSound = true;

    this.color = color;
    this.getColor(this.color);
    this.posX = posX;
    this.posY = posY;
    this.speedX = speedX / 3;
    this.speedY = speedY / 3;
    this.size = size;
    this.sprites = [new Image(), new Image()];
    this.sprites[0].src = '/storage/static/gamesImage/RabbitDance/rabbits/rabbit1' + this.color + '.png';
    this.sprites[1].src = '/storage/static/gamesImage/RabbitDance/rabbits/rabbit2' + this.color + '.png';
    
    this.img = this.sprites[0];

    this.animation((Math.abs((this.speedX + this.speedY) / 2) * 100), this.sprites);

  }

  getColor(color)
  {
    switch (color) {
      case 0:
        this.color = 'white'
        break;
      case 1:
        this.color = 'blue'
        break;
      case 2:
        this.color = 'red'
        break;
      case 3:
        this.color = 'yellow'
        break;
      default:
        this.color = 'white'
          break;
    }
  }
  
  draw(ctx, canvas)
  {
    ctx.fillStyle = '#FFA500';
    ctx.drawImage(this.img,this.posX,this.posY,this.size,this.size);
  }
  
  update(ctx)
  {
    this.posX += this.speedX;
    this.posY += this.speedY;

    if(this.canSound)
    {
      setInterval(() => this.doSound(), 1000 * Math.abs(this.speedX + this.speedY));
      this.canSound = false;
    }
    
    
  }

  doSound()
  {
      this.sound.play('rabbit');
      this.canSound = true;
  }

  animation(miliseconds) {

    let count = 0;

    let interval = setInterval(() => {
      if (count >= this.sprites.length) {
        count = 0;
      }
      this.img = this.sprites[count];
      count++;
    }, miliseconds);
  }
  
}