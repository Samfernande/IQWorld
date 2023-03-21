export class Rabbit {
  
  constructor(color, posX, posY, speedX, speedY, size) {
  
      this.color = color;
      this.posX = posX;
      this.posY = posY;
      this.speedX = speedX;
      this.speedY = speedY;
      this.size = size;
      this.img = new Image();
  
      this.img.src = "/storage/static/hiiro.png";
      
  }
  
  draw(ctx)
  {
      ctx.drawImage(this.img,this.posX,this.posY,this.size,this.size);
  }
  
  update(ctx)
  {
    this.posX += this.speedX;
    this.posY += this.speedY;
    
  }
}