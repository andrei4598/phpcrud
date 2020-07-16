function validaLogin() {

    //Check email
    var email = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(!email.test(document.loginForm.logEmail.value)) {
        alert("email invalida");
        return false;
    }

    //Check remember
    if(document.loginForm.remember.checked){
        alert("Hai scelto di ricordarti");
        }
    else alert("Hai scelto di NON ricordarti");

    return true;
};

const rmCheck = document.getElementById("defaultLoginFormRemember"),
    emailInput = document.getElementById("defaultLoginFormEmail");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  emailInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  emailInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && emailInput.value !== "") {
    localStorage.username = emailInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}

