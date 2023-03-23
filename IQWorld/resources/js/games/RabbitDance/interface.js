import { Soundizer } from "./audio";

export class Interface {

    constructor() {
      this.endTimer = true;
      this.endTimerRound = true;
      this.sound = new Soundizer();
    }

    drawInterface(canvas, ctx, textInformation, textTimer, positionX, positionY, sizeX, sizeY, color)
    {
        // Dessin de la barre
        ctx.fillStyle = color;
        ctx.fillRect(positionX, positionY, sizeX, sizeY);

    }

    drawText(text, font, textColor, textPositionX, textPositionY, ctx)
    {
        // Dessin du texte
        ctx.fillStyle = textColor;
        ctx.font = font
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(text, textPositionX, textPositionY);
    }
  
}