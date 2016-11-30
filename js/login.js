var rootURL = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/login";

function formToJSON() {
	return JSON.stringify({
		"user": $('#user').val(),
		"password": $('#password').val()
		});
}

function login() {
	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL,
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
            if(data.vino.length > 0){
                alert(data);
                alert(data.vino);
                alert(data.vino.id_cliente);
                localStorage.setItem("session", data.vino.id_cliente);
                alert(localStorage.getItem("session"));
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
