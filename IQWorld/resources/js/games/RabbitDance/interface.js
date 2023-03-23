import { Soundizer } from "./audio";

export class Interface {

    constructor() {
      this.endTimer = true;
      this.endTimerRound = true;
      this.sound = new Soundizer();
    }

    drawInterface(canvas, ctx, positionX, positionY, sizeX, sizeY, color)
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

    drawButton(ctx, canvas, positionX, positionY, sizeX, sizeY, color, method)
    {
        // dessiner le premier bouton
        ctx.fillStyle = color;
        ctx.fillRect(positionX, positionY, sizeX, sizeY);

        canvas.addEventListener('click', event => {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

            // vérifier si le bouton a été cliqué
            if (x >= 10 && x <= 110 && y >= 10 && y <= 60) {
                method();
            }
        });
    }
  
}