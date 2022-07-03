class Kreise {
    x;
    y;
    r;
    farbe;
    constructor(x, y, r, farbe) {
        this.x = x;
        this.y = y;
        this.r = r;
        this.farbe = farbe;
    }
    kreiseZeichen(context) {
        context.beginPath();
        context.fillStyle = this.farbe;
        context.arc(this.x, this.y, this.r, 0, Math.PI * 2);
        context.fill();
        context.closePath();
    }
    setNewx(x) {
        this.x = x;
    }
    setNewy(y) {
        this.y = y;
    }
    getx() {
        return this.x;
    }
    gety() {
        return this.y;
    }
    setdy(dy) {
        this.dy = dy;
    }
    testKreisePostion(height) {
        if (this.y + this.r >= height) {
            this.dy = -this.dy;
        }
    }
    moveAufYachse(height) {
        if (this.dy > 0 || (this.r + this.y > height / 1.8 && this.dy < 0)) {
            this.y += this.dy;
        }
    }
    dyZurucksetzen() {
        this.dy = -this.dy;
    }

}
module.exports = Kreise;