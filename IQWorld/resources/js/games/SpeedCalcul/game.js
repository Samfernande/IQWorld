import { AudioPlayer } from "./audio.js";
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
        // Sons
        this.countDownSound = new AudioPlayer('/storage/static/sounds/games/countDownSound.wav')

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
        this.designer.addParagraph('0:00', [], {color: 'white', position: 'absolute', right: 0, fontSize: '70%', margin: '5px'}, 'timer');
        this.designer.addParagraph('3 + 4 - ?', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 100%)', fontSize: '80%'}, 'operations');
        this.designer.addParagraph('11', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 350%)', fontSize: '60%'});
        this.designer.createCalculatorButtons();
        this.countDown();

        const { equation, result } = this.generateEquation();
        console.log(this.generateEquation());
        
    }


    async countDown() {
        const timerText = document.getElementById('timer');
        await this.timer.countDownWithCallback(60, secondsLeft => {
          timerText.textContent = secondsLeft;
          if (secondsLeft <= 3) {
            this.countDownSound.play();
          }
        });
        console.log("Le compte à rebours est terminé");
      }

    play()
    {
        

        

    }

    // Méthode génération l'équation

    generateEquation() {
        // Opérateurs
        const operations = ['+', '-', '/', '*'];

        // Nombres
        const num1 = Math.floor(Math.random() * 10) + 1;
        const num2 = Math.floor(Math.random() * 10) + 1;
        const num3 = Math.floor(Math.random() * 10) + 1;
      
        let equation; // Equation
        let result; // Resultat
        let attempts = 0; // Tentative si divisions

        // Si l'équation renvoi un mauvais résultat, le change
        do {

          const op1 = operations[Math.floor(Math.random() * operations.length)];
          const op2 = operations[Math.floor(Math.random() * operations.length)];
          equation = num1 + " " + op1 + " " + num2 + " " + op2 + " " + num3;
      
          switch (op1) {
            case '+':
              result = num1 + num2;
              break;
            case '-':
              result = num1 - num2;
              break;
            case '/':
                if (num1 % num2 === 0) 
                {
                    result = num1 / num2;
                }
                else
                {
                    result = null;
                }
              break;
            case '*':
              result = num1 * num2;
              break;
          }

          if(result < 0)
          {
            result = null;
          }
      
          if (result !== null) {
            switch (op2) {
              case '+':
                result += num3;
                break;
              case '-':
                result -= num3;
                break;
              case '/':
               result = null;
                break;
              case '*':
                result *= num3;
                break;
            }
          }

          if(result < 0)
          {
            result = null;
          }
      
          attempts++;
          if (attempts > 100) {
            throw new Error('Failed');
          }
        } while (result === null);
      
        return equation + ' = ' + result;

      }
}