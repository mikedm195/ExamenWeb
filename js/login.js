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
                a = data.vino[0].id_cliente;
                localStorage.setItem("session", a);
                console.log(localStorage.getItem("session"));
                localStorage.setItem("session", data.vino[0].id_cliente);
                //alert(localStorage.getItem("session"));
                //window.location = "index.html";
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
