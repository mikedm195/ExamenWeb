
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

function buscaCliente(){
    $.ajax({
		type: 'GET',
		contentType: 'application/json',
		url: rootURL,
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
            if(data.vino.length > 0){
                localStorage.setItem("session", data.vino[0].id_cliente);
                //alert(localStorage.getItem("session"));
                window.location = "index.html";
            }else{
                alert("Usuario y/o contraseña incorrectos");
            }
			//$('#btnBorrar').show();
			//$('#Idvino').val(data.id);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion agregaVino: ' + textStatus);
		}
	});
}
