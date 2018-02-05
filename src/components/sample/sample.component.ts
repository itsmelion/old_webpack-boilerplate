export class Sample {
    public name: string;
    constructor() {
        this.name = "sample component";
    }

    get whatsMyName() {
        return `My name is ${this.name}`;
    }
}
