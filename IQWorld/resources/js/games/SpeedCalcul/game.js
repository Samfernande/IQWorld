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
        this.isEquation = false; // Si une equation est déjà présente
        this.userValidation = false; // Si l'utilisateur valide sa réponse
        this.canErase = false; // Si l'utilisateur reset ce qu'il a écrit
        this.userCombo = 0;

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

        this.designer.addParagraph('', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 100%)', fontSize: '80%'}, 'operations');
        this.designer.addParagraph('', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 350%)', fontSize: '60%'}, 'userAnswer');

        this.operationText = document.getElementById('operations');
        this.userAnswer = document.getElementById('userAnswer');

        this.designer.createCalculatorButtons(this, this.userValidation);
        this.countDown();
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
      // S'il n'y a pas d'équations, en génère une
      if(!this.isEquation)
      {
        this.equation = this.generateEquation();
        this.operationText.textContent = this.equation[0];
        this.isEquation = true;
      }

      // Si texte supérieur ou égal à 3, le valide automatiquement
      if(this.userAnswer.textContent.length >= 3)
      {
        this.userValidation = true;
      }

      // Validation de la réponse
      // Juste
      if(this.userValidation && parseInt(this.userAnswer.textContent) == this.equation[2][this.equation[1]])
      {
        this.isEquation = false;
        this.userValidation = false;
        this.userCombo++;
        console.log('JUSTE');
        console.log(this.equation[2][this.equation[1]]);
        console.log(parseInt(this.userAnswer.textContent));
        this.userAnswer.textContent = '';

      }
      // Faux
      else if (this.userValidation && parseInt(this.userAnswer.textContent) != this.equation[2][this.equation[1]])
      {
        this.isEquation = false;
        this.userValidation = false;
        this.userCombo = 0;
        console.log('FAUX');
        console.log(this.equation[2][this.equation[1]]);
        console.log(parseInt(this.userAnswer.textContent));
        this.userAnswer.textContent = '';

      }

    }

    // Méthode de génération de l'équation
    // Retourne le string à afficher, l'index du nombre enlevé et les valeurs présentes
    generateEquation() {
        // Opérateurs
        const operations = ['+', '-', '*', '/'];

        // Nombres
        const num1 = Math.floor(Math.random() * 10) + 1;
        const num2 = Math.floor(Math.random() * 10) + 1;
        const num3 = Math.floor(Math.random() * 10) + 1;
      
        let equation; // Equation
        let equationMissing; // Equation
        let result; // Resultat
        let attempts = 0; // Tentative si divisions
        let values; // Toutes les valeurs changeables.
        let index; // Valeur qui change

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
          if (attempts > 500) {
            throw new Error('Failed');
          }

        values = [num1, num2, num3, result];
        index = Math.floor(Math.random() * values.length);
        values[index] = "?";
        equationMissing = values[0] + " " + op1 + " " + values[1] + " " + op2 + " " + values[2] + " = " + values[3];

        } while (result === null);

      
        // Retourne le string à afficher, l'index du nombre enlevé et les valeurs présentes
        return [equationMissing, index, [num1, num2, num3, result]];

      }
}