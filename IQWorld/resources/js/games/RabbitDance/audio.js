export class Soundizer {

    constructor() {
      this.endTimer = true;
      this.sounds = 
      [
        new Audio('/storage/static/sounds/games/countDownSound.wav'), 
        new Audio('/storage/static/sounds/games/rabbitSqueak.wav')
      ];
    }

    play(name)
    {
        if (name == 'rabbit')
        {
            this.sounds[1].play();
        }
        else if (name == 'countDown')
        {
            this.sounds[0].play();
        }
    }
  
}