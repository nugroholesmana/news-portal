function formRequired(formID, value) {
    var message = "";
    var isRequire = 0;
    $invalidForm = $("#invalid-"+formID+">.text-invalid");
    if(value == "" || value == 0 || value == '<p><br data-cke-filler="true"></p>'){
        message = "This field is required";
        $invalidForm.html(message);
        isRequire = 1;
    }else{
        $invalidForm.html('');
    }
    return isRequire;
}

function passwordMatch(password, confirmPassword) {
    $invalidForm = $("#invalid-confirmation_password>.text-invalid");
    if(password != confirmPassword){
        $invalidForm.html('Confirmation Password not match!');
    }

    return;
}