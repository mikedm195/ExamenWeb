// Definicion del End Point de los servicios RESTful
var rootURL = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/parcial3/ejercicios/23-11-16/Vinos/api/index.php/vinos";

var vinoActual;

// Recupera la lista de vinos cuando la aplicacion se ejecute
buscaTodo();

// Nada que borrar en el estado inicial de la aplicacion
$('#btnBorrar').hide();

// Registramos los listeners
$('#btnBuscar').click(function() {
	search($('#llaveBuscar').val());
	return false;
});

// Activar la busqueda al pulsar 'Return' en el campo de entrada de la tecla de búsqueda
$('#llaveBuscar').keypress(function(e){
	if(e.which == 13) {
		search($('#llaveBuscar').val());
		e.preventDefault();
		return false;
    }
});

$('#btnAgregar').click(function() {
	nuevoVino();
	return false;
});

$('#btnGuardar').click(function() {
	if ($('#Idvino').val() == '')
		agregaVino();
	else
		actualizaVino();
	return false;
});

$('#btnBorrar').click(function() {
	borraVino();
	return false;
});

$('#listaVino a').live('click', function() {
	console.log("hola");
	findById($(this).data('identidad'));
});

// Reemplazamos las imagenes inexistentes con la botella de vino genérico
$("img").error(function(){
  $(this).attr("src", "pics/generic.jpg");

});

function search(llaveBuscar) {
	if (llaveBuscar == '')
		buscaTodo();
	else
		findByName(llaveBuscar);
}

function nuevoVino() {
	$('#btnBorrar').hide();
	vinoActual = {};
	renderDetails(vinoActual); // Despliega la forma vacia
}

function buscaTodo() {
	console.log('buscaTodo');
	$.ajax({
		type: 'GET',
		url: rootURL,
		dataType: "jsonp", // tipo de dato de la respuesta
		success: renderList
	});
}

function findByName(llaveBuscar) {
	console.log('findByName: ' + llaveBuscar);
	$.ajax({
		type: 'GET',
		url: rootURL + '/search/' + llaveBuscar,
		dataType: "jsonp",
		success: renderList
	});
}

function findById(id) {
	console.log('findById: ' + id);
	$.ajax({
		type: 'GET',
		url: rootURL + '/' + id,
		dataType: "jsonp",
		success: function(data){
			$('#btnBorrar').show();
			console.log('findById con exito: ' + data.nombre);
			vinoActual = data;
			renderDetails(vinoActual);
		}
	});
}

function agregaVino() {
	console.log('agregaVino');
	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL,
		dataType: "jsonp",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('Vino creado exitosamente');
			$('#btnBorrar').show();
			$('#Idvino').val(data.id);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion agregaVino: ' + textStatus);
		}
	});
}

function actualizaVino() {
	console.log('actualizaVino');
	$.ajax({
		type: 'PUT',
		contentType: 'application/json',
		url: rootURL + '/' + $('#Idvino').val(),
		dataType: "jsonp",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('Vino actualizado exitosamente');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion actualizaVino: ' + textStatus);
		}
	});
}

function borraVino() {
	console.log('borraVino');
	$.ajax({
		type: 'DELETE',
		url: rootURL + '/' + $('#Idvino').val(),
		success: function(data, textStatus, jqXHR){
			alert('Vino borrado exitosamente');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion borraVino');
		}
	});
}

function renderList(data) {
	// tomado de stack overflow
	// JAX-RS serializes an empty list as null, and a 'collection of one' as an object (not an 'array of one')
	var list = data == null ? [] : (data.vino instanceof Array ? data.vino : [data.vino]);

	$('#listaVino li').remove();
	$.each(list, function(index, vino) {
		$('#listaVino').append('<li><a href="#" data-identidad="' + vino.id + '">'+vino.nombre+'</a></li>');
	});
}

function renderDetails(vino) {
	$('#Idvino').val(vino.id);
	$('#nombre').val(vino.nombre);
	$('#uvas').val(vino.uvas);
	$('#pais').val(vino.pais);
	$('#region').val(vino.region);
	$('#anio').val(vino.anio);
	$('#pic').attr('src', 'pics/' + vino.imagen);
	$('#descripcion').val(vino.descripcion);
}

// Función auxiliar para serializar todos los campos de formulario en una cadena JSON
function formToJSON() {
	return JSON.stringify({
		"id": $('#Idvino').val(),
		"nombre": $('#nombre').val(),
		"uvas": $('#uvas').val(),
		"pais": $('#pais').val(),
		"region": $('#region').val(),
		"anio": $('#anio').val(),
		"picture": vinoActual.picture,
		"descripcion": $('#descripcion').val()
		});
}
