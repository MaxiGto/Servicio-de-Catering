(function() {
    "use strict"

    document.addEventListener("DOMContentLoaded", function() {

        const nombre = document.querySelector('#nombre');
        const apellido = document.querySelector('#apellido');
        const email = document.querySelector('#email');
        const telefono = document.querySelector('#telefono');
        const usuario = document.querySelector('#usuario');
        const password = document.querySelector('#password');
        const password2 = document.querySelector('#password2');
        const btnRegistro = document.querySelector('#registrar');
        const errorRegistro = document.querySelector('#error-registro');
        
        btnRegistro.addEventListener("click", function(e) {

            if (nombre.value == "") {
                e.preventDefault();
                nombre.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (apellido.value == "") {
                e.preventDefault();
                apellido.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (email.value == "") {
                e.preventDefault();
                email.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (telefono.value == "") {
                e.preventDefault();
                telefono.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (usuario.value == "") {
                e.preventDefault();
                usuario.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (password.value == "") {
                e.preventDefault();
                password.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            if (password2.value == "") {
                e.preventDefault();
                password2.style.border = "1px solid red";
                errorRegistro.innerHTML = "Todos los campos son obligatorios";
            }

            nombre.onclick = function() {
                nombre.style.border = "none";
            }

            apellido.onclick = function() {
                apellido.style.border = "none";
            }

            email.onclick = function() {
                email.style.border = "none";
            }

            telefono.onclick = function() {
                telefono.style.border = "none";
            }

            usuario.onclick = function() {
                usuario.style.border = "none";
            }

            password.onclick = function() {
                password.style.border = "none";
            }

            password2.onclick = function() {
                password2.style.border = "none";
            }


        });





    }); // DOM Content Loaded




})();