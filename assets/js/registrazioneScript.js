function regCheck() {

 
   //Check password
    var pass=/^[A-Za-z0-9]{8,20}$/;
    if(document.registrationForm.regPassword.value.length<8 || document.registrationForm.regPassword.value.length>20){
        alert("minimo 8 , massimo 20 caratteri");
        return false;
    }
    if(!pass.test(document.registrationForm.regPassword.value)){
    alert("password non valida , inseriscine una nuova");
    return false;
}



return true;
}

$(function(){
    $('[data-toggle="tooltip"]').tooltip();
})



