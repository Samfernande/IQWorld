import { AudioPlayer } from "./audio.js"

export class Designer
{
    constructor(gameDiv, gameRect)
    {
        this.gameDiv = gameDiv;
        this.gameRect = gameRect;

        this.buttonClickSound = new AudioPlayer('/storage/static/sounds/games/buttonClick.wav');

    }

    // Exemple d'utilisation :
    /*
    this.designer.addParagraph('Bonjour le monde!', ['text-center', 'text-lg'], {color: 'white', position: 'absolute', fontSize: '12px'});
    */
    addParagraph(text, cssClasses = [], cssStyles = {}, id = 'paragraph') {
        const p = document.createElement('p');
        p.textContent = text;
        p.classList.add(...cssClasses);
        p.id = id;
        Object.assign(p.style, cssStyles);
        this.gameDiv.insertAdjacentElement('beforeend', p);
      }

    createCalculatorButtons() {
      const calculatorDiv = document.createElement("div");
      calculatorDiv.classList.add("calculator");
      for (let i = 9; i > 0; i--) {
          const button = document.createElement("button");
          button.textContent = i;
          button.addEventListener("click", () => {
              console.log(`You clicked button ${i}`);
              this.buttonClickSound.stop();
              this.buttonClickSound.play();
          });
          calculatorDiv.appendChild(button);
      }
  
      const yoyo = document.createElement("button");
      yoyo.classList.add("yoyo");
      yoyo.textContent = "E";
      yoyo.addEventListener("click", () => {
          console.log(`You clicked the yoyo button`);
          this.buttonClickSound.stop();
          this.buttonClickSound.play();
      });
      calculatorDiv.appendChild(yoyo);
  
      const zeroButton = document.createElement("button");
      zeroButton.classList.add("zero");
      zeroButton.textContent = 0;
      zeroButton.addEventListener("click", () => {
          console.log(`You clicked button 0`);
          this.buttonClickSound.stop();
          this.buttonClickSound.play();
      });
      calculatorDiv.appendChild(zeroButton);
  
      const clearButton = document.createElement("button");
      clearButton.classList.add("clear");
      clearButton.textContent = "C";
      clearButton.addEventListener("click", () => {
          console.log(`You clicked the clear button`);
          this.buttonClickSound.stop();
          this.buttonClickSound.play();
      });
      calculatorDiv.appendChild(clearButton);
  
      this.gameDiv.appendChild(calculatorDiv);
  
      // Add keydown event listener
      document.addEventListener('keydown', function(event) {
          let button = null;
          switch (event.key) {
              case '1':
                  button = document.querySelector('.calculator button:nth-child(9)');
                  break;
              case '2':
                  button = document.querySelector('.calculator button:nth-child(8)');
                  break;
              case '3':
                  button = document.querySelector('.calculator button:nth-child(7)');
                  break;
              case '4':
                  button = document.querySelector('.calculator button:nth-child(6)');
                  break;
              case '5':
                  button = document.querySelector('.calculator button:nth-child(5)');
                  break;
              case '6':
                  button = document.querySelector('.calculator button:nth-child(4)');
                  break;
              case '7':
                  button = document.querySelector('.calculator button:nth-child(3)');
                  break;
              case '8':
                  button = document.querySelector('.calculator button:nth-child(2)');
                  break;
              case '9':
                  button = document.querySelector('.calculator button:nth-child(1)');
                  break;
              case '0':
                  button = document.querySelector('.calculator .zero');
                  break;
              case 'Backspace':
                  button = document.querySelector('.calculator .clear');
                  break;
          }
          if (button) {
              button.click();
          }
      });
  }

    addButton(text, cssClasses = [], cssStyles = {}, position = 'beforeend', clickFunction) {
        const button = document.createElement('button');
        button.textContent = text;
        button.classList.add(...cssClasses);
        Object.assign(button.style, cssStyles);
        button.addEventListener('click', clickFunction);
        this.gameDiv.insertAdjacentElement(position, button);
    }

    reset() 
    {
        while (this.gameDiv.firstChild) 
        {
            this.gameDiv.removeChild(this.gameDiv.firstChild);
        }
    }

}