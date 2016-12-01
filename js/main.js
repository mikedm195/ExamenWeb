
if(localStorage.getItem("session") != ''){
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{
    $('#loginBtn').show();
    $('#logoutBtn').hide();
    $('#miInformacion').hide();
}

//============Cliente======================//
buscaCliente();
function logout(){
    localStorage.setItem("session", '');
}


function buscaCliente(){
    if(localStorage.getItem("session") != ''){
        var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente/" + localStorage.getItem("session");

        $.ajax({
    		type: 'GET',
    		url: url,
    		dataType: "json",
    		success: function(data, textStatus, jqXHR){
                var cliente = data;
                if(cliente){
                    $('#nombreCliente').val(cliente.nombre);
                	$('#apPaternoCliente').val(cliente.apPaterno);
                	$('#apMaternoCliente').val(cliente.apMaterno);
                	$('#telefonoCliente').val(cliente.telefono);
                	$('#membresiaCliente').val(cliente.membresia);
                    $('#userCliente').val(cliente.user);
                	$('#passwordCliente').val(cliente.password);
                }else{
                    alert("Usuario y/o contraseña incorrectos");
                }
    		},
    		error: function(jqXHR, textStatus, errorThrown){
    			alert('Error en la funcion getCliente: ' + textStatus);
    		}
    	});
    }
}

function obtenerDatosCliente() {
	return JSON.stringify({
            "nombre": $('#nombreCliente').val(),
            "apPaterno": $('#apPaternoCliente').val(),
            "apMaterno": $('#apMaternoCliente').val(),
            "foto": $('#fotoCliente').val(),
            "telefono": $('#telefonoCliente').val(),
            "membresia": $('#membresiaCliente').val(),
            "user": $('#userCliente').val(),
            "password": $('#passwordCliente').val(),
		});
}

function  actualizarCliente(){
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente/" + localStorage.getItem("session");
	$.ajax({
		type: 'PUT',
		contentType: 'application/json',
		url: url,
		dataType: "json",
		data: obtenerDatosCliente(),
		success: function(data, textStatus, jqXHR){
			console.log('Cliente actualizado exitosamente');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion actualizaVino: ' + textStatus);
		}
	});
}

//============tienda======================//
buscarTiendas();

$('#listaTiendas a').on("click", function() {
    console.log($(this).data('identidad'));
	buscaTiendaId($(this).data('identidad'));
});

function buscarTiendas() {
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/tienda";
	$.ajax({
		type: 'GET',
		url: url,
		dataType: "json",
		success: function(data, textStatus, errorThrown) {
            data = data.tiendas;
        	$('#listaTiendas li').remove();
        	$.each(data, function(index, tienda) {
        		$('#listaTiendas').append('<li class="list-group-item"><a href="#" data-identidad="' + tienda.id_tienda + '">'+tienda.nombre+'</a></li>');
        	});
		}
	});
}

function buscaTiendaId(id) {
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/tienda/"+id;
    console.log(id);
	$.ajax({
		type: 'GET',
		url: url,
		dataType: "json",
		success: function(data){
			console.log('findById con exito: ' + data.nombre);
			vinoActual = data;
			renderDetails(vinoActual);
		}
	});
}
