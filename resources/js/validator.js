const patterns = {
    // onlyletters: /^[A-Za-zÀ-ÿ]+$/,
    user: /^[a-zA-Z0-9]{4,16}$/,
    onlyletters: /^[a-zA-ZÀ-ÿ\s]+$/,
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
 
 $('#country').bind('keypress', testInput);