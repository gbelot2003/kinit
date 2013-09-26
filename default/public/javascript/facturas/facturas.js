function funSubTotal(precio, cantidad) // Esta funcion se encarga de sacarte los subtotales
{
	sub = precio * cantidad;
	return parseFloat(sub).toFixed(2); // le pasamos el parseFlote por si las moscas y retornamos la funcion u_u
}

$(document).ready(function(){
	$(".id input").each(function(){ // comenzamos el bucle del event listener (algo así como el escucha de evento) 
		$(this).focusout(function(){ // el evento a escuchar es el focusout (cuando la caja de texto pierda foco)
			
			var r = $(this).val(); // capturamos el valor de la caja de texto

			//creamos las variables hermanas como globales para poder acceder desde el $.post() al tiempo de capturar el valor de la caja arriba

			nombre = $(this).parent().siblings('.nombre'); // Agregamos el td class nombre de la fila que corresponde
			precio = $(this).parent().siblings('.precio'); // Agregamos el td class precio de la fila que corresponde
			cantidad = $(this).parent().siblings('.cantidad'); //agregamos el td class cantidad de la fila que corresponde
			subTotal1 = $(this).parent().siblings('.subtotal');//agregamos el td class subtotal de la fila que corresponde
			C = 1; //extraemos el total de cantidad
			

			$.post( "facturas/callback/" + r, function(data){ // aquí comienza la magia (u_u), el primer parametro es la url del callback y agregamos el valor de la
															// caja de texto en r para que la url quede como "facturas/callback/1" donde 1 es el codigo a buscar

				// se debia haber configurado el callback de forma que nos devuelba json, hay una libreria llamada así, descargala he implementala.				
				// Esto nos devuelve desde callback, un string tipo JSON igual a este [{id:1, nombre:coca-cola, precio:13}]


				var obj = jQuery.parseJSON(data); // Limpiamos y decodificamos la respuesta JSON de callback anteriormente mensionada
				pres1 = parseFloat(obj.precio).toFixed(2); //combertimos a decimal

				nombre.html(obj.nombre); //Extraemos el valor de nombre
				precio.html(pres1); // Extraemos el valor de presio

				SubTotal = funSubTotal(pres1, C); //Aquí obtenemos el subtotal
				subTotal1.html(SubTotal); // y por supuesto agregamos el subtotal a su fila correspondiente
				$('.table').sumtr({sumCells : '.subtotal'});

			});
		});
	});

	$('.cantidad input').each(function(){
		$(this).focusout(function(){
			C1 = $(this).val(); // aquí es para multiplcar el "por" de cantidad al hacer lostfocus
			precio2 = $(this).parent().siblings('.precio').html(); //de nuevo agregamos a variable el td class precio

			SubTotal1 = funSubTotal(precio2, C1); // reusamos la funcion fubSubTotal()
			subTotal1.html(SubTotal1); // y refrescamos el valor de subtotal cada ves que cambie la cantidad.
			$('.table').sumtr({sumCells : '.subtotal'}); // aqui insertamos la suma total de la fila .subtotal y uso un plug-in de jquery para 
														//evitar hacer mas largo el script y facilitar la implementación
														// el script es este https://github.com/DLarsen/jquery-sumtr
		});
	});
});
