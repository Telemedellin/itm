(function($)
{
	// Filtro de falcultades
	$('.faculty-filter > span').on('click', function(evt) {
		$('.faculty-filter').children().removeClass('select');
		$(this).addClass('select');
		filtrar();
		evt.stopPropagation();
	});

	// Filtros de tipo de programa y metodologías
	$('.checkbox-itm > input').on('change', function(evt) {
		filtrar();
		evt.stopPropagation();
	});

	// Metodo que se encargara de hacer las peticiones ajax para los filtros
	function filtrar() {
		var data			= {};

		data['facultad']	= null;

		if ($('.faculty-filter').length > 0)
			data['facultad'] = $('.faculty-filter > span.select').attr('class').split(" ")[1];
		else
			data['facultad'] = $('.entry-title').attr('class').split(" ")[1];

		var checkbox_list	= $('.checkbox-itm > input');
		$.each(checkbox_list, function (k, v) {
			v.checked ? data[v.id] = true : data[v.id] = false;
		});

		/*$.ajax({
			url: '',
			method: 'POST',
			data: data,
		});*/
		console.log(data);
	}
})(jQuery);