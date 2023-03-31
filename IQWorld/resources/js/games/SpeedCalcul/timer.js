export class Timer {
    constructor() {
        this.startTime = 0;
        this.endTime = 0;
    }

    start() {
        this.startTime = Date.now();
    }

    stop() {
        this.endTime = Date.now();
    }

    getElapsedTime() {
        return (this.endTime - this.startTime) / 1000;
    }

    // Méthode de countDown
    async countDown(seconds) {
        return new Promise(resolve => setTimeout(resolve, seconds * 1000));
    }

    // Méthode de countDown avec retour de variable
    async countDownWithCallback(seconds, callback) {
        for (let i = seconds; i > 0; i--) {
            callback(i);
            await this.countDown(1);
        }
        callback(0);
    }
}