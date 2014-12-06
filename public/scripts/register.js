// Validates the email
function check_email() {
    var email = document.getElementById('email').value;
    var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (email == '' || re.test(email)) {
        document.getElementById('email_err').textContent = '';
    } else {
        document.getElementById('email_err').textContent = 'wrong email format';
    }
}

// Validates the password
function check_password() {
    var password = document.getElementById("password1").value;

    if (password == '' || password.length >= 7) {
        document.getElementById('pass_err').textContent = '';
    }
    else {
        document.getElementById('pass_err').textContent = 'Invalid password';
    }
}


function match_passwords() {

}