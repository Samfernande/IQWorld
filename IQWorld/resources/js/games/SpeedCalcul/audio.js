export class AudioPlayer {
    constructor(src) {
      this.audio = new Audio(src);
    }
  
    play() {
      this.audio.play();
    }
  
    pause() {
      this.audio.pause();
    }
  
    stop() {
      this.audio.pause();
      this.audio.currentTime = 0;
    }
  }