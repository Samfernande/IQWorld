export class AttenTouchGame
{
    constructor(gameDiv, playerRank)
    {
        console.log('oula')
        // Configurations
        this.gameDiv = gameDiv
        this.gameRect = gameDiv.getBoundingClientRect();
        this.isLogging = true;
        this.endGame = false;

        if(!playerRank)
        {
            this.playerRank = 0;
            this.isLogging = false;
        }
        else
        {
            this.playerRank = playerRank;
        }
    }

    play()
    {
        
    }
}