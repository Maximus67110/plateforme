import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    connect() {
        const input = document.getElementById("boat_city");
        const datalist = document.createElement("datalist");
        datalist.id = "cities";
        input.addEventListener("input", function(event){
            const city = event.target.value.toLowerCase();
            const url = `/city?name=${city}`;
            fetch(url)
                .then(response => response.json())
                .then(cities => {
                    datalist.innerHTML = '';
                    for(const city of cities){
                        const option = document.createElement("option");
                        option.value = city.ville_nom_reel;
                        option.textContent = city.ville_nom_reel;
                        datalist.appendChild(option);
                    }
                    input.parentElement.append(datalist);
                });
        });
    }
}
