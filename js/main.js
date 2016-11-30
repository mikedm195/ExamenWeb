var a = "hola"
localStorage.setItem("lastname", a);
console.log(localStorage.getItem("lastname"));
if(localStorage.getItem("session") == ''){
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{
    $('#loginBtn').show();
    $('#logoutBtn').hide();
}
