export class Timer
{
    constructor()
    {
        this.isEnd = false;
        this.counter = 0;
    }

    playTimer(milisecondsInterval, counter) {

        this.counter = counter;
        
        return new Promise(resolve => {
            const interval = setInterval(() => {
                if (this.countDown()) {
                    clearInterval(interval);
                    resolve(true);
                }
            }, milisecondsInterval);
        });
    }
    
    countDown() {
        this.counter--;
    
        if (this.counter == 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}