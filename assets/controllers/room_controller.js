import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['collectionContainer']
    static values = {
        index: Number,
        prototype: String,
    }

    connect() {
        document
            .querySelectorAll('#room_detail fieldset')
            .forEach((tag) => {
                this.addTagFormDeleteLink(tag);
            })
    }

    addTagFormDeleteLink(item) {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Delete tag';
        removeFormButton.classList.add('btn');
        removeFormButton.classList.add('btn-danger');
        item.append(removeFormButton);
        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            item.remove();
        });
    }

    addBed()
    {
        const container = document.getElementById('room_detail');
        const item = document.createElement('fieldset');
        item.classList.add('mb-3');
        item.innerHTML += this.prototypeValue.replace(/__name__/g, this.indexValue);
        container.append(item);
        this.addTagFormDeleteLink(item);
        this.indexValue++;
    }
}
