document.onload = function(){
    alert(localStorage.getItem("session"));
    if(localStorage.getItem("session") == ''){
        $('#loginBtn').hide();
        $('#logoutBtn').show();
    }else{
        $('#loginBtn').show();
        $('#logoutBtn').hide();
    }
}
