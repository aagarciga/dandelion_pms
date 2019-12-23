export default class PageTransitionOverlay {
    constructor(shapesElement, duration = 600) {
        this.element = shapesElement;
        this.path = shapesElement.querySelectorAll("path");
        this.numPoints = 2;
        this.duration = duration;
        this.delayPointsArray = [];
        this.delayPointsMax = 0;
        this.delayPerPath = duration / 3;
        this.timeStart = Date.now();
        this.isOpened = false;
        this.isAnimating = false;

        this.ease = {
            cubicOut: (t) => {
                const f = t - 1.0;
                return f * f * f + 1.0;
            },
            cubicInOut: (t) => {
                return t < 0.5
                    ? 4.0 * t * t * t
                    : 0.5 * Math.pow(2.0 * t - 2.0, 3.0) + 1.0;
            },
        };
    }

    calculatePathStep(time) {
        let result = "";
        const points = [];
        for (let i = 0; i<this.numPoints; i++){
            const currentEase = this.isOpened ?
                (i === 1) ? this.ease.cubicOut : this.ease.cubicInOut :
                (i === 1) ? this.ease.cubicInOut : this.ease.cubicOut;
            points[i] = currentEase(Math.min(Math.max(time - this.delayPointsArray[i], 0) / this.duration, 1)) * 100;
        }

        result += (this.isOpened) ? `M 0 0 V ${points[0]} ` : `M 0 ${points[0]} `;
        for (let i = 0; i < this.numPoints - 1; i++) {
            const p = (i+1) / (this.numPoints - 1) * 100;
            const cp = p - (1 / (this.numPoints - 1) * 100) / 2;
            result += `C ${cp} ${points[i]} ${cp} ${points[i + 1]} ${p} ${points[i + 1]} `;
        }
        result += (this.isOpened) ? "V 0 H 0" : "V 100 H 0";
        return result;
    }

    render() {
        let i = 0;
        while(i < this.path.length){
            if (this.isOpened) {
                let ltrStep = this.calculatePathStep(Date.now() - (this.timeStart + this.delayPerPath * i));
                this.path[i].setAttribute("d", ltrStep);
            } else {
                let rtlStep = this.calculatePathStep(Date.now() - (this.timeStart + this.delayPerPath * (this.path.length - i - 1)));
                this.path[i].setAttribute("d", rtlStep);
            }
            i++;
        }
    }

    renderLoop() {
        this.render();
        let currentTime = Date.now() - this.timeStart;
        let currentStep = this.duration + this.delayPerPath * (this.path.length - 1) + this.delayPointsMax;
        if(currentTime < currentStep){
            requestAnimationFrame(() => {
                this.renderLoop();
            });
        } else {
            this.isAnimating = false;
        }
    }

    open(callback) {
        for (let i = 0; i < this.numPoints; i++) {
            this.delayPointsArray[i] = 0;
        }
        this.isOpened = true;
        this.element.classList.add("is-opened");
        this.timeStart = Date.now();
        this.renderLoop();
        callback();
    }

    close(callback) {
        for (let i = 0; i < this.numPoints; i++) {
            this.delayPointsArray[i] = 0;
        }
        this.isOpened = false;
        this.element.classList.remove('is-opened');
        this.timeStart = Date.now();
        this.renderLoop();
        callback();
    }

    toggle(callback) {
        this.isAnimating = true;
        if (this.isOpened === false){
            this.open(callback);
        } else {
            this.close(callback);
        }
    }
}