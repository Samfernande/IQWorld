import { Rabbit } from "./rabbit"

export class Game
{
    constructor(gameDiv)
    {
        // Configurations
        this.gameDiv = gameDiv
        this.gameRect = gameDiv.getBoundingClientRect();
        this.rabbits = [];

        //GameManager
        this.startGame = true;
        this.updateGame = false;
        this.endRound = false;
        this.results = false;
        this.end = false;
        this.round = 0;

        // Game
        this.playerPoints = 0;
        this.numberRabbit = 0;
        this.playerAnswer = 0;
    }

    play()
    {
        if(this.startGame)
        {
            this.rabbits = [];
            this.deleteAllChildren();
            this.colorRabbit = this.random(0, 3);
            this.getColor();
            this.createRabbits();
            this.numberRabbit = this.rabbits.filter(rabbit => rabbit.color === this.colorRabbit).length;
            console.log(this.numberRabbit)
            this.createParagraph("instructions", "color: white; font-size: 50%;", "Concentrez-vous...");
            this.countdownRound();
            this.startGame = false;
            this.updateGame = true;
            this.round++;
        }

        if (this.updateGame)
        {
            this.update();
        }

        if (this.endRound)
        {
            this.deleteAllChildren();
            this.createParagraph("instructions", "color: white; font-size: 70%; text-align: center", "Combien de lapins " + this.colorRabbit +" se promenaient ?")
            this.createInterface();
            this.endRound = false;
        }

        if (this.results)
        {
            this.deleteAllChildren();
            if(this.playerAnswer == this.numberRabbit)
            {
                this.playerPoints += 250;
                this.createParagraph("instructions", "color: white; font-size: 70%; text-align: center", "Bien joué !")
                this.createParagraph("instructions", "color: white; font-size: 70%; text-align: center", this.playerPoints + "pts")
            }
            else
            {
                this.createParagraph("instructions", "color: white; font-size: 70%; text-align: center", "Dommage...");
                this.createParagraph("instructions", "color: white; font-size: 70%; text-align: center", this.playerPoints + "pts")
            }
            
            let confirmButton = document.createElement("button");
            confirmButton.innerHTML = "Continuer";
            confirmButton.classList = "buttonGame";

            let self = this;
            confirmButton.addEventListener("click", function() {
            self.startGame = true;
            });

            this.gameDiv.appendChild(confirmButton);


            this.results = false;
        }
    }

    getColor()
    {
        switch (this.colorRabbit) {
            case 0:
                this.colorRabbit = 'blue';
              break;
            case 1:
                this.colorRabbit = 'red';
              break;
            case 2:
                this.colorRabbit = 'white';
              break;
            case 3:
                this.colorRabbit = 'yellow';
              break;
            default:
                this.color = 'white';
                break;
          }
    }

    deleteParagraph(id) {
        let p = document.getElementById(id);
        p.parentNode.removeChild(p);
    }

    deleteAllChildren() {
        while (this.gameDiv.firstChild) {
            this.gameDiv.removeChild(this.gameDiv.firstChild);
        }
    }

    createParagraph(id, styles, content) {
        let p = document.createElement("p");
        p.id = id;
        p.style = styles;
        p.textContent = content;
        this.gameDiv.appendChild(p);
    }

    // Compte à rebours pour les rounds
    countdownRound() {
        let count = 3;
        let countdownText = document.createElement('p');
        this.gameDiv.appendChild(countdownText);
        let countdownSound = new Audio('/storage/static/sounds/games/countDownSound.wav');
        let countdownInterval = setInterval(() => {
            if (count >= 0) {
                countdownText.textContent = count;
                countdownSound.play();
                count--;
            } 
            else 
            {
                this.updateGame = false;
                this.endRound = true;
                clearInterval(countdownInterval);
            }
        }, 1000);
    }

    createRabbits()
    {
        // Création des lapins
        for(let i = 0; i < this.random(1 + Math.round(this.round / 4), 5 + Math.round(this.round / 4)) ; i++)
        {
            this.rabbits.push(new Rabbit(this.random(0, this.gameRect.right - 250), this.random(0, this.gameRect.top), this.random(1 + (this.round / 5), 4 + (this.round / 5)), this.random(1 + (this.round / 5), 4 + (this.round / 5)), this.random(100, 250), this.random(0, 4)));
            this.gameDiv.appendChild(this.rabbits[i].img)
        }
    }

    random(min, max) {
        return Math.round(Math.random() * (max - min) + min);
    }

    update() {
        this.rabbits.forEach((rabbit) => {
            rabbit.move(this.gameRect);
            rabbit.img.style.position = 'absolute';
            rabbit.img.style.width = rabbit.size + 'px';
            rabbit.img.style.height = rabbit.size + 'px';
            rabbit.img.style.left = rabbit.x + 'px';
            rabbit.img.style.top = rabbit.y + 'px';
        });
    }

    createInterface() {
        // Crée les éléments
        let minusButton = document.createElement("button");
        minusButton.innerHTML = "-";
        minusButton.classList = "buttonGame";
        let plusButton = document.createElement("button");
        plusButton.innerHTML = "+";
        plusButton.classList = "buttonGame";
        let number = document.createElement("p");
        number.textContent = "1";
        number.style = "font-size: 50%"
        let confirmButton = document.createElement("button");
        confirmButton.innerHTML = "Confirmer";
        confirmButton.classList = "buttonGame";
      
        // Ajoute les événements aux boutons
        minusButton.addEventListener("click", function() {
          if (parseInt(number.textContent) > 0) {
            number.textContent = parseInt(number.textContent) - 1;
          }
        });
        plusButton.addEventListener("click", function() {
          if (parseInt(number.textContent) < 20) {
            number.textContent = parseInt(number.textContent) + 1;
          }
        });

            let self = this;
            confirmButton.addEventListener("click", function() {
                self.playerAnswer = parseInt(number.textContent);
                self.results = true;
            });
      
        // Ajoute les éléments à la div "game"
        this.gameDiv.appendChild(minusButton);
        this.gameDiv.appendChild(number);
        this.gameDiv.appendChild(plusButton);
        this.gameDiv.appendChild(confirmButton);
      }
    
}
