const firstname = document.getElementById("firstname");
const lastname = document.getElementById("lastname");
const email = document.getElementById("email");
const password = document.getElementById("password");
const verifyObject = {
    "firstName": false,
    "lastName": false,
    "email": false,
    "checkNumber": false,
    "checkUpperChar": false,
    "checkEightChar": false,
    "checkSpecialChar": false
}
document.addEventListener("keyup", (e) => {
    // console.log(e.target.value);
    // console.log(e.key);
    if (e.target == firstname || e.target == lastname)
        verifyName(e)
    else if (e.target == password)
        verifyPassword(e)
    else if (e.target == email)
        verifyEmail(e)

})
function verifyName(e) {
    const stringOnly = /[a-zA-Z]w*/
    if (!stringOnly.test(e.key)) {
        e.target.value = e.target.value.slice(0, -1);
    }
    if (firstname.value.length > 0)
        verifyObject.firstName = true;
    else
        verifyObject.firstName = false;
    if (lastname.value.length > 0)
        verifyObject.lastName = true;
    else
        verifyObject.lastName = false
}
function verifyEmail(e) {
    const emailRegex = /[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-Z]/
    if (emailRegex.test(email.value)) {
        verifyObject.email = true;
    }
    else
        verifyObject.email = false;

}
function verifyPassword(e) {
    const numberCheckRegex = /\d/g;
    const uppercaseCheckRegex = /[A-Z]/;
    const specialCharCheckRegex = /[!@#$%%^&*()\[\]\\\/'";:<>,.?~`*-+=-_]/;
    if (numberCheckRegex.test(password.value)) {
        document.getElementById("one-number").style.color = "#00ff00";
        verifyObject.checkNumber = true
    }
    else {
        document.getElementById("one-number").style.color = "#ff0000";
        verifyObject.checkNumber = false;
    }
    if (password.value.length >= 8) {
        document.getElementById("eight-char").style.color = "#00ff00";
        verifyObject.checkEightChar = true;
    }
    else {
        document.getElementById("eight-char").style.color = "#ff0000";
        verifyObject.checkEightChar = false;
    }
    if (uppercaseCheckRegex.test(password.value)) {
        document.getElementById("one-upper").style.color = "#00ff00";
        verifyObject.checkUpperChar = true;
    }
    else {
        document.getElementById("one-upper").style.color = "#ff0000";
        verifyObject.checkUpperChar = false;
    }
    if (specialCharCheckRegex.test(password.value)) {
        document.getElementById("one-special").style.color = "#00ff00";
        verifyObject.checkSpecialChar = true;
    }
    else {
        document.getElementById("one-special").style.color = "#ff0000";
        verifyObject.checkSpecialChar = false;
    }
}
function submitForm() {
    console.log(verifyObject);
    if (verifyObject.firstName && verifyObject.lastName && verifyObject.email
        && verifyObject.checkEightChar && verifyObject.checkNumber &&
        verifyObject.checkSpecialChar
        && verifyObject.checkUpperChar) {
        alert("Account created Successfully");
    }
    else {
        alert("Unable to create account");
    }
}
