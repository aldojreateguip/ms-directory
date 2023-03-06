const patterns = {
    // onlyletters: /^[A-Za-zÀ-ÿ]+$/,
    user: /^[a-zA-Z0-9]{4,16}$/,
    onlyletters: /^[(a-zA-ZÀ-ÿ)+\s?]+$/,
    words: /([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/,
    password: /^.{8,20}$/, // 4 a 12 digitos.
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    phone_number: /^\d{7,14}$/,
    iddoc: /^(?:\d{8}|\d{20})$/,
};

function testInput(event) {
    var value = String.fromCharCode(event.which);
    var pattern = patterns.onlyletters;
    return pattern.test(value);
}

$("#acountry").bind("keypress", testInput);
$("#adepartment").bind("keypress", testInput);
$("#amunicipality").bind("keypress", testInput);
$("#ucountry").bind("keypress", testInput);
$("#udepartment").bind("keypress", testInput);
$("#umunicipality").bind("keypress", testInput);

// function alphaOnly(event) {
//     var key = event.keyCode;
//     `enter code here`;
//     return (key >= 65 && key <= 90) || key == 8;
// }
