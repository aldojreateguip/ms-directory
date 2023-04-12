//check role selection
var roleCheckBoxes = document.querySelectorAll("input[type=checkbox]");
var roleSubmit = document.querySelector("#saveRole");

function checkRoleCheckBoxes() {
    let checked = false;

    roleCheckBoxes.forEach((checkbox) => {
        if (checkbox.checked) {
            checked = true;
        }
    });
    if (checked) {
        roleSubmit.disabled = false;
        roleSubmit.classList.remove("btn-secondary");
        roleSubmit.classList.add("btn-success");
    } else {
        roleSubmit.disabled = true;
        roleSubmit.classList.add("btn-secondary");
        roleSubmit.classList.remove("btn-success");
    }
}
roleCheckBoxes.forEach((checkbox) => {
    checkbox.addEventListener("change", checkRoleCheckBoxes);
});
