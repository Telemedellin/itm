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

	//Menú lateral para móviles
	var btn_menu = $(".menu-lateral_titulo h3");//Disparador para el menú principal
	var menu = $(".ctn__menu-lateral .menu");//Selección del contendor del menú principal
	var btn_submenu = $(".menu > li > .sub-menu").siblings('a');//Disparador del sebmenú
	var submenu = $(".menu > li > .sub-menu");//Selección del contenedor del submenu de segundo nivel
	var btn_submenu2 = $(".menu > li > .sub-menu > li > .sub-menu").siblings('a');//Disparador para el sebmenú de tercer nivel
	var submenu2 = $(".menu > li > .sub-menu > li > .sub-menu");//Selección del contenedor del submenu de tercer nivel


	function slideMenu(selector){ //Función para activar el slide y agregar la clase current
		event.preventDefault();
		selector.slideToggle('slow/400/fast');
		if (selector.siblings('a').hasClass('current') ) {
			selector.siblings('a').removeClass('current')
		} else{
			selector.siblings('a').addClass('current');
		};
	}

	btn_menu.on('click', function(event) {
		slideMenu(menu);
	});

	btn_submenu.on('click', function(event) {
		slideMenu(submenu);
		iconRotate();
	});

	btn_submenu2.on('click', function(event) {
		slideMenu(submenu2);
	});
})(jQuery);