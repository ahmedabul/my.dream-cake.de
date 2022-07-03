class Welle {
    x;
    yEbene;
    amplitude;
    wl;
    c;
    constructor(x, c, amplitude, wl) {
        this.x = x;
        this.yEbene = c.height / 2;
        this.amplitude = amplitude;
        this.wl = wl;
        this.c = c;
    }
    moveWelle(c, context) {
        this.createCreise(this.x, this.getKreiseDaten(), context);
    }
    getKreiseDaten() {

        return this.yEbene + Math.sin(this.x * this.amplitude) * this.wl;
    }
    createCreise(x, y, context) {
        context.beginPath();
        context.fillStyle = 'red';
        context.arc(x, y, 2, 0, Math.PI * 2);
        context.fill();
    }
    welleMitFrequenz(f, context) {
        context.beginPath();
        if (this.strokestyle == null) {
            context.strokeStyle = 'red';
        } else {
            context.strokeStyle = this.strokestyle;
        }

        for (var x = 0; x <= this.c.width; x += 0.1) {
            this.zeichenWelle(x, this.getYwert(x, f), context);
        }
        context.stroke();

    }
    getYwert(x, f) {
        return this.yEbene + Math.sin(x * this.amplitude + f) * this.wl;
    }
    zeichenWelle(x, y, context) {
        context.lineTo(x, y);

    }
    changeYebene(yEbene) {
        this.yEbene = yEbene;
    }
    setztStrokeStyle(color) {
        this.strokestyle = color;
    }
}
module.exports = Welle;