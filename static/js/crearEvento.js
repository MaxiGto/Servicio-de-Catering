(function() {
    "use strict"

    document.addEventListener("DOMContentLoaded", function() {

        const fecha = document.querySelector("#fecha");

        fecha.addEventListener("change", function(){

            let fechaFinal = document.querySelector("#fecha-final");

            let date = new Date(fecha.value);

            fechaFinal.value = date.toISOString().slice(0, 19).replace('T', ' ');

        });

        








    }); // DOM Content Loaded




})();