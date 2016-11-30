
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
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente/" + localStorage.getItem("session");
    console.log(url);
    $.ajax({
		type: 'GET',
		url: url,
		dataType: "json",
		success: function(data, textStatus, jqXHR){
            var cliente = data.vino;
            console.log(cliente);
            console.log(data);
            if(cliente){
                $('#nombreCliente').val(cliente.id);
            	$('#apPaternoCliente').val(cliente.nombre);
            	$('#apMaternoCliente').val(cliente.uvas);
            	$('#fotoCliente').val(cliente.pais);
            	$('#telefonoCliente').val(cliente.region);
            	$('#membresiaCliente').val(cliente.anio);
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
