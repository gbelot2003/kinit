/*** Test **/

function showRow(data){
	var obj = jQuery.parseJSON(data);
    j  = "<tr>";
	j += "<td><img src='" + obj.url + "' class='img-rounded img-polaroid' width='200'/></td>";
	j += "<td>" + obj.titulo + "</td>";
	j += "<td><a class='btn borrar' href='archivos/delDatos/"+ obj.id +"'>borrar</a></td>";
	j += "</tr>";
	$("#imagenes").find("tbody").prepend(j);
	//$('#res').html('');	
}

function showTable(data){
	// Esta funcion espera una respuesta JSON desde el servidor
	var row = "";
	if(data.length == 0){
	//$("#imagenes tbody").append("<h3 id='nohay'>No hay Imagenes</h3>");
	}
	else
	{
		for(var i = 0; i < data.length; i++){
			j  = "<tr>";
			j += "<td><img src='" + data[i].url + "' class='img-rounded img-polaroid' width='200'/></td>";
			j += "<td>" + data[i].titulo + "</td>";
			j += "<td><a class='btn borrar' href='archivos/delDatos/"+ data[i].id +"'>borrar</a></td>";
			j += "</tr>";
	    	$("#imagenes").find("tbody").append(j);
	    }			
	}
}

function deleteRow(){
	$("body").on('click', ".borrar", function(event){
		event.preventDefault();
		var unt = $(this);
		var self = $(this).attr("href");
		$.ajax({
			type: 'GET',
			url: self,
    		beforeSend: function() {
          	 //$('#res').html('Borrando...');
        	},
			success: function(data){
			//	$('#res').html('');
				unt.parent().parent().hide('slow');
			}
		});
	});	
}

$(document).ready(function(){
	deleteRow();
});

$(document).ready(function(){
	$.ajax({ 
	    type: 'GET', 
	    url: 'archivos/tableCallBack', 
	    data: { get_param: 'value' }, 
	    dataType: 'json',
	    success: function (data) { 
			showTable(data);
	    }
	});
});

$(document).ready(function()
{
	$('form').ajaxForm({
    	beforeSubmit: function() {
       //    $('#res').html('Enviando...');
        },
        success: function(data) {
			showRow(data);
        },
        error: function(data){
        	$('#res').html('Problemas en el envio de la informacio ');
        	
        }
        
    });
});
