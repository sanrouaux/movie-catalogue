window.onload = function() {

    document.onclick = function(event) {

        var signinLink = document.getElementsByClassName('signin-link')[0];
        var loginLink = document.getElementsByClassName('login-link')[0];
        var firstName = document.getElementById('firstName');
        var lastName = document.getElementById('lastName');
        var button = document.getElementById('button-accept');

        if(event.target.matches('.login-link')) {
            loginLink.style.fontWeight = 'bold';
            loginLink.style.fontSize = '1.3rem';
            signinLink.style.fontWeight = 'normal';
            signinLink.style.fontSize = '1rem';
            firstName.style.display = 'none';
            lastName.style.display = 'none';
            document.getElementsByClassName('create-account-validation-name')[0].hidden = true;
            document.getElementsByClassName('create-account-validation-lastName')[0].hidden = true;
            document.getElementsByClassName('create-account-validation-email')[0].hidden = true;
            document.getElementsByClassName('create-account-validation-password')[0].hidden = true;
            button.onclick = Login;
        }
        else if(event.target.matches('.signin-link')) {
            signinLink.style.fontWeight = 'bold';
            signinLink.style.fontSize = '1.3rem';
            loginLink.style.fontWeight = 'normal';
            loginLink.style.fontSize = '1rem';
            firstName.style.display = 'inline-block';
            lastName.style.display = 'inline-block';
            button.onclick = Signin;
        }
    };
};


function Login() {

    var email = document.getElementById('email');
    var password = document.getElementById('password');

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./login");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('email='+email.value+'&password='+password.value);

    xhr.onreadystatechange = function () {
        if(xhr.status == 200 && xhr.readyState == 4)
        {
            response = JSON.parse(xhr.response);

            if(response.valid)
            {                
                localStorage.setItem('firstName', response.user.firstName);
                localStorage.setItem('lastName', response.user.lastName);
                localStorage.setItem('profile', response.user.profile);
                window.location.href="./catalog";
            }
            else
            {
                alert("Usuario o contraseña incorrectos");
                email.value = '';
                password.value = '';
            } 
        }
    }
}

function Signin() {
    
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    
    var validationResult = validateNewAccount(firstName, lastName, email, password);

    if(validationResult) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./signin");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('firstName='+firstName+'&lastName='+lastName+'&email='+email+'&password='+password);

        xhr.onreadystatechange = function () {
            if(xhr.status == 200 && xhr.readyState == 4)
            {
                response = JSON.parse(xhr.response);
                if(response.ok)
                {                
                    alert('El usuario ' + response.user.name + ' ' + response.user.lastName + ' fue registrado.')
                    window.location.href = './';
                }
                else {
                    alert(response.message);
                    firstName.value = '';
                    lastName.value = '';
                    email.value = '';
                    password.value = '';
                }
            }
        }
    }
}

function validateNewAccount (firstName, lastName, email, password) {
    if(firstName == "") {        
        document.getElementsByClassName('create-account-validation-name')[0].hidden = false;
    }
    else {
        document.getElementsByClassName('create-account-validation-name')[0].hidden = true;
        var firstNameOk = true;
    }
    
    if(lastName == "") {        
        document.getElementsByClassName('create-account-validation-lastName')[0].hidden = false;
    }
    else {
        document.getElementsByClassName('create-account-validation-lastName')[0].hidden = true;
        var lastNameOk = true;
    }
    
    var regex = /\S+@\S+\.\S+/;
    if(!regex.test(email)) {
        document.getElementsByClassName('create-account-validation-email')[0].hidden = false;        
    }
    else {       
        document.getElementsByClassName('create-account-validation-email')[0].hidden = true; 
        var emailOk = true;  
    }
    
    if(password == "") {
        document.getElementsByClassName('create-account-validation-password')[0].hidden = false;        
    }
    else {
        document.getElementsByClassName('create-account-validation-password')[0].hidden = true;  
        var passwordOk = true;
    }

    if(firstNameOk && lastNameOk && emailOk && passwordOk) {
        return true;
    }
    else {
        return false;
    }
}