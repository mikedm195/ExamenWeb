
if(localStorage.getItem("session") != ''){
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{
    $('#loginBtn').show();
    $('#logoutBtn').hide();
}

buscaCliente();
function logout(){
    localStorage.setItem("session", '');
}


function buscaCliente(){    
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/getCliente/" + localStorage.getItem("session");
    $.ajax({
		type: 'GET',
		contentType: 'application/json',
		url: url,
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
            var cliente = data.vino.length;
            if(cliente > 0){
                $('#nombreCliente').val(coiente.id);
            	$('#apPaternoCliente').val(coiente.nombre);
            	$('#apMaternoCliente').val(coiente.uvas);
            	$('#fotoCliente').val(coiente.pais);
            	$('#telefonoCliente').val(coiente.region);
            	$('#membresiaCliente').val(coiente.anio);
            }else{
                alert("Usuario y/o contraseña incorrectos");
            }
			//$('#btnBorrar').show();
			//$('#Idvino').val(data.id);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion getCliente: ' + textStatus);
		}
	});
}
