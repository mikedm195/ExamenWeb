console.log(localStorage.getItem("session"));
if(localStorage.getItem("session") == ''){
    console.log("out");
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{
    console.log("in");
    $('#loginBtn').show();
    $('#logoutBtn').hide();
}
