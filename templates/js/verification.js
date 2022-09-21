function validateForm()
{
    var name = document.forms["myForm"]["nom"];
    if (name.value == ""){
        document.getElementById('errorname').innerHTML="Veuillez entrez un nom valide";
        name.focus();
        return false;
    }else{
        document.getElementById('errorname').innerHTML="";
    }
}
function validateForms()
{
    var password = document.forms["myForm"]["password"];
    if (password.value == ""){
        document.getElementById('errorpassword').innerHTML="Veuillez saisir un mot de passe valide";
        password.focus();
        return false;
    }else{
        document.getElementById('errorpassword').innerHTML="";
    }
}