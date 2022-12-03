function inchargediv() {
    // Nav Changes
    user = document.getElementById('userli');
    incharge = document.getElementById('inchargeli');
    read = document.getElementById('readli');
    user.style.backgroundColor = '#222327';
    user.style.color = 'white';
    read.style.backgroundColor = '#222327';
    read.style.color = 'white';
    incharge.style.backgroundColor = 'aqua';
    incharge.style.color = '#222327';
    // Login Changes
    userlogindiv = document.getElementById('userlogin');
    inchargelogindiv = document.getElementById('inchargelogin');
    readlogindiv = document.getElementById('readlogin');
    userlogindiv.style.display = 'none';
    readlogindiv.style.display = 'none';
    inchargelogindiv.style.display = 'grid';
}
function userdiv() {
    // Nav Changes
    user = document.getElementById('userli');
    incharge = document.getElementById('inchargeli');
    read = document.getElementById('readli');
    incharge.style.backgroundColor = '#222327';
    incharge.style.color = 'white';
    read.style.backgroundColor = '#222327';
    read.style.color = 'white';
    user.style.backgroundColor = 'aqua';
    user.style.color = '#222327';
    // Login Changes
    userlogindiv = document.getElementById('userlogin');
    inchargelogindiv = document.getElementById('inchargelogin');
    readlogindiv = document.getElementById('readlogin');
    inchargelogindiv.style.display = 'none';
    readlogindiv.style.display = 'none';
    userlogindiv.style.display = 'grid';
}
function readdiv(){
    // Nav Changes
    user = document.getElementById('userli');
    incharge = document.getElementById('inchargeli');
    read = document.getElementById('readli');
    user.style.backgroundColor = '#222327';
    user.style.color = 'white';
    incharge.style.backgroundColor = '#222327';
    incharge.style.color = 'white';
    read.style.backgroundColor = 'aqua';
    read.style.color = '#222327';
    //Login Changes
    userlogindiv = document.getElementById('userlogin');
    inchargelogindiv = document.getElementById('inchargelogin');
    readlogindiv = document.getElementById('readlogin');
    inchargelogindiv.style.display = 'none';
    userlogindiv.style.display = 'none';
    readlogindiv.style.display = 'grid';
}

function usernamehelp() {
    txt = document.getElementById('username-help-text');
    txt.style.display = 'inline';
}
function usernamehelped() {
    txt = document.getElementById('username-help-text');
    txt.style.display = 'none';
}

function passhelp() {
    txt = document.getElementById('pass-help-text');
    txt.style.display = 'inline';
}
function passhelped() {
    txt = document.getElementById('pass-help-text');
    txt.style.display = 'none';
}

function validateForm() {
    formusername = document.forms["userform"]["user-name"].value;
    formuserpass = document.forms["userform"]["user-pass"].value;
    formusercpass = document.forms["userform"]["user-cpass"].value;

    invalidchars = "1234567890~!@#$%^&*()[]{};':,.<>/?";
    flag = true;

    for (let i = 0; i < formusername.length; i++) {
        if(invalidchars.indexOf(formusername.charAt(i)) != -1){
            flag = false;
        }
    }
    if (flag == false){
        alert("Invalid Username");
        return false;
    }
    else if(formusercpass != formuserpass){
        alert("password and confirm password must match")
        return false;
    }
}