import { Sample } from './sample.component';

describe('Sample', () => {
    const sample = new Sample();

    it('Should answer the question: whats your name? ...', () => {
        expect(sample.whatsMyName).toBe('My name is sample component');
    });

    it('Should print name', () => {
        expect(sample.name).toBe('sample component');
    });

});
