import { Designer } from "./designer.js"
import { Timer } from "./timer.js"

export class SpeedCalculGame
{
    constructor(gameDiv, playerRank)
    {
        // Configurations
        this.gameDiv = gameDiv
        this.gameRect = gameDiv.getBoundingClientRect();
        this.isLogging = true;
        this.endGame = false;

        // Objets importants !
        this.designer = new Designer(this.gameDiv, this.gameRect);
        this.timer = new Timer();

        // Variables du jeu

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
        this.designer.addParagraph('0pts', [], {color: 'white', position: 'absolute', left: 0, fontSize: '70%', margin: '5px'});
        this.designer.addParagraph('0:00', [], {color: 'white', position: 'absolute', right: 0, fontSize: '70%', margin: '5px'});
        this.designer.addParagraph('3 + 4 - ?', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 100%)', fontSize: '80%'});
        this.designer.addParagraph('11', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 350%)', fontSize: '60%'});
        this.designer.createCalculatorButtons();
        this.example();
    }

    async example() {
        await this.timer.countDownWithCallback(5, secondsLeft => console.log(secondsLeft));
        console.log("Le compte à rebours est terminé");
    }

    play()
    {


    }
}