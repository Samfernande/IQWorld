import { Designer } from "./designer.js"

export class SpeedCalculGame
{
    constructor(gameDiv, playerRank)
    {
        // Configurations
        this.gameDiv = gameDiv
        this.gameRect = gameDiv.getBoundingClientRect();
        this.isLogging = true;
        this.endGame = false;
        this.designer = new Designer(this.gameDiv, this.gameRect);

        if(!playerRank)
        {
            this.playerRank = 0;
            this.isLogging = false;
        }
        else
        {
            this.playerRank = playerRank;
        } 
        
        // Programm
        this.designer.reset();
        this.designer.addParagraph('On your calculators !', [], {color: 'white', position: 'absolute', fontSize: '50%', transform: 'translate(0, 3%)'});
        this.designer.addParagraph('0pts', [], {color: 'white', position: 'absolute', left: 0, fontSize: '50%', margin: '5px'});
        this.designer.addParagraph('0:00', [], {color: 'white', position: 'absolute', right: 0, fontSize: '50%', margin: '5px'});
        this.designer.addParagraph('3 + 4 - _', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 100%)', fontSize: '80%'});
        this.designer.createCalculatorButtons();
    }

    play()
    {


    }
}