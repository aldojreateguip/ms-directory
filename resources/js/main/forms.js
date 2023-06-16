const inputs = document.querySelectorAll("#forms input");

const patterns = {
    // onlyletters: /^[A-Za-zÀ-ÿ]+$/,
    user: /^[a-zA-Z0-9]{4,16}$/,
    onlyletters: /^[a-zA-ZÀ-ÿ\s]+$/,
    password: /^.{8,20}$/, // 4 a 12 digitos.
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    phone_number: /^\d{7,14}$/,
    iddoc: /^(?:\d{8}|\d{20})$/,
    dni: /^(?:\d{8})$/,
    ruc: /^(?:\d{11})$/,
};

// function alphaOnly(event) {
//     var key = event.keyCode;
//     `enter code here`;
//     return (key >= 65 && key <= 90) || key == 8;
// }

// inputs.forEach((input) => {
//     input.addEventListener("keyup", validate);
//     input.addEventListener("blur", validate);
// });

function validateForm() {
    let isValid = true;

    inputs.forEach((input) => {
        const pattern = patterns[input.dataset.pattern];
        const value = input.value.trim();
        const errorMessage = document.getElementById(input.dataset.error);

        if (pattern && !pattern.test(value)) {
            isValid = false;
            errorMessage.style.display = "block";
        } else {
            errorMessage.style.display = "none";
        }
    });

    return isValid;
}

function cambiarPatron() {
    var select = document.getElementById("miSelect");
    var input = document.getElementById("miInput");
    
    if (select.value === "opcion1") {
      input.setAttribute("pattern", patterns.dni); // Cambia el patrón del input a cuatro dígitos numéricos
    } else if (select.value === "opcion2") {
      input.setAttribute("pattern", patterns.ruc); // Cambia el patrón del input a tres letras
    }
}