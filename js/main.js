
if(localStorage.getItem("session") != ''){
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{    
    $('#loginBtn').show();
    $('#logoutBtn').hide();
}

function logout(){
    localStorage.setItem("session", '');
}
