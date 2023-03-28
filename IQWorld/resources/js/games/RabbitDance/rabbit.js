export class Rabbit
{
    constructor(x, y, speedX, speedY, size, color)
    {

        this.color = color;
        this.getColor();

        this.img = new Image();
        this.imgSource = ['/storage/static/gamesImage/RabbitDance/rabbits/rabbit1' + this.color +'.png', 
                          '/storage/static/gamesImage/RabbitDance/rabbits/rabbit2' + this.color +'.png'
                         ];
        this.img.src = this.imgSource[0];
        this.counterAnimation = 0;

        this.x = x;
        this.y = y;
        this.speedX = speedX;
        this.speedY = speedY
        this.size = size;

        setInterval(() => {
            this.animation();
        }, 1 / ((this.speedX + this.speedY) / 1000));
    }

    animation()
    {
        if(this.counterAnimation == 0)
        {
            this.img.src = this.imgSource[1];
            this.counterAnimation++;
        }
        else
        {
            this.img.src = this.imgSource[0];
            this.counterAnimation = 0;
        }
    }

    move(gameRect)
    {
        this.x += this.speedX;
        this.y += this.speedY;

        if (this.x < 0 || this.x > gameRect.width - this.size - 10) {
            this.speedX =- this.speedX;
        }
    
        if (this.y < 0 || this.y > gameRect.height - this.size - 10) {
            this.speedY =- this.speedY;
        }
    }

    getColor()
    {
        switch (this.color) {
            case 0:
                this.color = 'blue';
              break;
            case 1:
                this.color = 'red';
              break;
            case 2:
                this.color = 'white';
              break;
            case 3:
                this.color = 'yellow';
              break;
            default:
                this.color = 'white';
                break;
          }
    }
}