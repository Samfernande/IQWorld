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
        this.countDownSound = new AudioPlayer('/storage/static/sounds/games/countDownSound.wav');
        this.rightAudio = new Audio('/storage/static/sounds/games/right.wav');
        this.falseAudio = new Audio('/storage/static/sounds/games/false.wav');

        // Variables du jeu
        this.isEquation = false; // Si une equation est déjà présente
        this.userValidation = false; // Si l'utilisateur valide sa réponse
        this.canErase = false; // Si l'utilisateur reset ce qu'il a écrit
        this.userCombo = 0;
        this.playerPoints = 0;
        this.playerReactionTime = [];
        this.playerAccuracy = 0;
        this.round = 0;
        this.rightAnswer = 0;

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
        this.designer.addParagraph('0pts', [], {color: 'white', position: 'absolute', left: 0, fontSize: '70%', margin: '5px'}, 'playerPoints');
        this.designer.addParagraph('0:00', [], {color: 'white', position: 'absolute', right: 0, fontSize: '70%', margin: '5px'}, 'timer');

        this.designer.addParagraph('', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 100%)', fontSize: '80%'}, 'operations');
        this.designer.addParagraph('', [], {color: 'white', position: 'absolute', transform: 'translate(0%, 350%)', fontSize: '60%'}, 'userAnswer');
        this.designer.addParagraph('Combo : 0', [], {color: 'white', position: 'absolute', fontSize: '50%', left: 0, bottom: 0, margin: '5px'}, 'userCombo');

        this.operationText = document.getElementById('operations');
        this.userAnswer = document.getElementById('userAnswer');
        this.playerPointsText = document.getElementById('playerPoints');
        this.userComboText = document.getElementById('userCombo');

        this.designer.createCalculatorButtons(this, this.userValidation);
        this.countDown();
    }


    getAverage(numbers) {
      if (numbers.length === 0) {
          return 0; // ou toute autre valeur par défaut
      }
  
      var sum = numbers.reduce(function(total, value) {
          return total + value;
      }, 0);
  
      var average = sum / numbers.length;
  
      return Number(average.toFixed(3));
  }

    async countDown() {
        const timerText = document.getElementById('timer');
        await this.timer.countDownWithCallback(60, secondsLeft => {
          timerText.textContent = secondsLeft;
          if (secondsLeft <= 3) {
            this.countDownSound.play();
          }
        });

        this.playerReactionTime = this.getAverage(this.playerReactionTime);
        this.playerAccuracy = Number((this.rightAnswer / this.round).toFixed(2));
        this.endGame = true;
      }

        changeBackgroundColor(color) {
          if(color == 'green')
          {
            this.gameDiv.classList.add('animateColor');
          }
          else
          {
            this.gameDiv.classList.add('animateColorWrong');
          }
        this.gameDiv.addEventListener('animationend', () => {
          this.gameDiv.classList.remove('animateColor');
          this.gameDiv.classList.remove('animateColorWrong');
        });
      }

    play()
    {
      // S'il n'y a pas d'équations, en génère une
      if(!this.isEquation)
      {
        this.round++;

        if(this.userCombo == 5)
        {
          this.userComboText.textContent = 'Combo : MAX';
        }
        else
        {
          this.userComboText.textContent = 'Combo : ' + this.userCombo;
        }
        this.equation = this.generateEquation();
        this.operationText.textContent = this.equation[0];
        this.isEquation = true;
        this.timer.start();
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
        this.rightAnswer++;
        this.isEquation = false;
        this.userValidation = false;
        this.userCombo++;
        this.rightAudio.play();
        this.userAnswer.textContent = '';
        this.changeBackgroundColor('green');
        this.timer.stop();
        this.playerReactionTime.push(this.timer.getElapsedTime());

        if(this.userCombo >= 5)
        {
          this.userCombo = 5;
        }

        this.playerPoints += Math.round(10 * (this.userCombo * 2) * ((this.playerRank * 1.5) + 1));
        this.playerPointsText.textContent = this.playerPoints + "pts";

      }
      // Faux
      else if (this.userValidation && parseInt(this.userAnswer.textContent) != this.equation[2][this.equation[1]])
      {
        this.isEquation = false;
        this.userValidation = false;
        this.userCombo = 0;
        this.falseAudio.play();
        this.userAnswer.textContent = '';
        this.changeBackgroundColor('red');
        this.timer.stop();
      }

    }

    // Méthode de génération de l'équation
    // Retourne le string à afficher, l'index du nombre enlevé et les valeurs présentes
    generateEquation() {
        // Opérateurs
        let operations = [];
        console.log(this.playerRank + "RANK");

        console.log(this.playerRank);
        if(this.playerRank == 0)
        {
          operations = ['+'];
        }
        else if(this.playerRank >= 1 && this.playerRank <= 3)
        {
          operations = ['+', '-'];
        }
        else if(this.playerRank >= 4 && this.playerRank <= 6)
        {
          operations = ['+', '-', '*'];
        }
        else if(this.playerRank >= 7)
        {
          operations = ['+', '-', '*', '/'];
        }

        // Nombres
        const num1 = Math.floor(Math.random() * (3 + this.playerRank)) + 1;
        const num2 = Math.floor(Math.random() * (3 + this.playerRank)) + 1;
        const num3 = Math.floor(Math.random() * (3 + this.playerRank)) + 1;
      
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
                result = null;
                break;
            }
          }

          if(result <= 0)
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