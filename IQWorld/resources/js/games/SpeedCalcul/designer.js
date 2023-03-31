export class Designer
{
    constructor(gameDiv, gameRect)
    {
        this.gameDiv = gameDiv;
        this.gameRect = gameRect;
    }

    // Exemple d'utilisation :
    /*
    this.designer.addParagraph('Bonjour le monde!', ['text-center', 'text-lg'], {color: 'white', position: 'absolute', fontSize: '12px'});
    */
    addParagraph(text, cssClasses = [], cssStyles = {}, position = 'beforeend') {
        const p = document.createElement('p');
        p.textContent = text;
        p.classList.add(...cssClasses);
        Object.assign(p.style, cssStyles);
        this.gameDiv.insertAdjacentElement(position, p);
    }

    createCalculatorButtons() {
        const calculatorDiv = document.createElement("div");
        calculatorDiv.classList.add("calculator");
        for (let i = 9; i > 0; i--) {
          const button = document.createElement("button");
          button.textContent = i;
          button.addEventListener("click", () => {
            console.log(`You clicked button ${i}`);
          });
          calculatorDiv.appendChild(button);
        }
        const zeroButton = document.createElement("button");
        zeroButton.classList.add("zero");
        zeroButton.textContent = 0;
        zeroButton.addEventListener("click", () => {
          console.log(`You clicked button 0`);
        });
        calculatorDiv.appendChild(zeroButton);
      
        const clearButton = document.createElement("button");
        clearButton.classList.add("clear");
        clearButton.textContent = "Clear";
        clearButton.addEventListener("click", () => {
          console.log(`You clicked the clear button`);
        });
        calculatorDiv.appendChild(clearButton);
      
        this.gameDiv.appendChild(calculatorDiv);
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