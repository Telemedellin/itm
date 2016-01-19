(function($)
{
	var path = window.location.origin;
	var content_path = path + '/wp-content';
	var admin_path = path + '/wp-admin';
	var theme_path = content_path + '/themes/itm';

	// Filtro de falcultades
	$('.faculty-filter > span').on('click', function(evt) {
		$('.faculty-filter').children().removeClass('select');
		$(this).addClass('select');
		filtrarProgramasFacultades();
		evt.stopPropagation();
	});

	// Filtros de tipo de programas academicos
	$('.formacion-filters .checkbox-itm > input, .metodology-formacion-filters .checkbox-itm > input').on('change', function(evt) {
		filtrarProgramas();
		evt.stopPropagation();
	});

	// Filtros de tipo de programas academicos para oferta academica
	$('.oferta-filters .checkbox-itm > input, .metodology-oferta-filters .checkbox-itm > input').on('change', function(evt) {
		filtrarProgramasFacultades();
		evt.stopPropagation();
	});

	// Filtro de extensiones academicas
	$('.extension-filter > span').on('click', function(evt) {
		if ($(this).hasClass('select'))
			$('.extension-filter').children().removeClass('select');
		else
		{
			$('.extension-filter').children().removeClass('select');
			$(this).addClass('select');
		}
		filtrarExtensiones();
		evt.stopPropagation();
	});

	// Filtros de tipo de programas para extensiones academicas
	$('.sede-filters .checkbox-itm > input').on('change', function(evt) {
		filtrarExtensiones();
		evt.stopPropagation();
	});

	// Filtro de autocompletar
	$('.input-filter input').on('keyup', function(evt) {
		var element = $(this);
		var text = element.val();
		var tipo = element.attr('id');

		if (text.length > 2 && evt.which <= 90 && evt.which >= 48)
		{
			var parent = $('#primary').attr('cat') == undefined ? 0 : $('#primary').attr('cat');
			$.ajax({
				method: "POST",
				url: admin_path + "/admin-ajax.php",
				data: {
					'action' : 'getProgramasCat',
					'parent' : parent,
					'tipo'	 : tipo
				},
				beforeSend: function()
				{
					$(".input-filter").append('<div class="loading-search"></div>');
				},
				success: function(data)
				{
					var source = data.result;
					$('.input-filter input').autocomplete({
						option: true,
						source: source,
						minLength: 2,
						appendTo: '.ctn__input-result',
						select: function(event, ui) {
							autocompleteItemSelect(ui.item);
						}
					});
				}
			})
			.done(function()
			{
				$(".loading-search").remove();
			});
		}
		evt.stopPropagation();
	});

	function autocompleteItemSelect(item)
	{
		window.location = item.url;
	}

	function filtrarProgramasFacultades()
	{
		var data			= {};
		data['tipo']		= $('.filter-label.select').attr('rel') == undefined ? '' : $('.filter-label.select').attr('rel');
		var checkbox_list	= $('.checkbox-itm > input');

		$.each(checkbox_list, function (k, v) {
			v.checked ? data[v.id] = true : data[v.id] = null;
		});

		$.ajax({
			url: theme_path + '/ajax/filtro-programas-facultades.php',
			method: 'POST',
			data: data,
			beforeSend: function()
			{
				// Mostrar el efecto de cargando...
				$('.ctn__section-content').css({
					height: '573px'
				});
				$('.overlay-filter').show();
			},
			success: function(data)
			{
				// grid container
				var container = $('.ctn__facultad.hidden').get(0);
				// grid item
				var grid_item = $('.ctn__programa.hidden').get(0);

				var grid_items = [];
				var container_items = [];

				$('.ctn__grids').html('');

				$.each(data, function(tipo,programas) {
					var params = tipo.split('::');
					var _container = $(container).clone().removeAttr('style').removeClass('hidden').get(0);
					_container.children[0].children[0].innerText = params[0];
					$(_container.children[1]).addClass('brd__' + params[1])
					$.each(programas, function (key, programa) {
						var _grid_item = $(grid_item).clone().removeAttr('style').removeClass('hidden').get(0);
						// a.ctn__programa
						_grid_item.href = programa.enlace;
						// ctn__programa-image
						var style = _grid_item.children[0].children[0].style;
						var img_url = $(programa.imagen).attr('src');
						style.background = 'url("http://lorempixel.com/400/400") 50% 50% / 100% no-repeat';
						style.backgroundPosition = '50% 50%';
						style.backgroundSize = '100%';
						
						// ctn__programa-image > img
						//_container.children[0].children[0].children[0].src = img_url;
						
						// ctn__programa_top > h3
						_grid_item.children[0].children[1].innerText = programa.titulo;

						// Título a otorgar
						_grid_item.children[1].children[0].children[1].innerText = programa.titulo_otorgado;
						// Modalidad
						_grid_item.children[1].children[0].children[3].innerText = programa.modalidad_text;
						// Duración
						_grid_item.children[1].children[0].children[5].innerText = programa.duracion;

						$(_container.children[1]).append(_grid_item);
					});

					container_items.push(_container);
					$('.ctn__grids').append(container_items);
				});

				if (container_items.length == 0)
				{
					var msg = $('#msg__sin-resultados').clone().removeAttr('style');
					$('.ctn__grids').append(msg);
				}

				$('.overlay-filter').hide();
				$('.ctn__section-content').css({
					height: 'auto'
				});
			}
		});
	}

	// Metodo que se encargara de hacer las peticiones ajax para los filtros
	function filtrarProgramas()
	{
		var data			= {};
		data['cat']			= $('#primary').attr('cat');
		var checkbox_list	= $('.checkbox-itm > input');

		$.each(checkbox_list, function (k, v) {
			v.checked ? data[v.id] = true : data[v.id] = null;
		});

		$.ajax({
			url: theme_path + '/ajax/filtro-programas.php',
			method: 'POST',
			data: data,
			beforeSend: function()
			{
				// Mostrar el efecto de cargando...
				$('.ctn__section-content').css({
					height: '573px'
				});
				$('.overlay-filter').show();
			},
			success: function(data)
			{
				var container = $('.ctn__programa.hidden').get(0);
				var items = [];
				$.each(data, function(k,v) {
					// a.ctn__programa
					var _container = $(container).clone().removeAttr('style').removeClass('hidden').get(0);
					_container.href = v.enlace;
					// ctn__programa-image
					var style = _container.children[0].children[0].style;
					var img_url = $(v.imagen).attr('src');
					style.background = 'url("http://lorempixel.com/400/400") 50% 50% / 100% no-repeat';
					style.backgroundPosition = '50% 50%';
					style.backgroundSize = '100%';
					
					// ctn__programa-image > img
					//_container.children[0].children[0].children[0].src = img_url;
					
					// ctn__programa_top > h3
					_container.children[0].children[1].innerText = v.titulo;

					// Titulo otorgado
					_container.children[1].children[0].children[1].innerText = v.titulo_otorgado;
					// Modalidad
					_container.children[1].children[0].children[3].innerText = v.modalidad_text;
					// Duración
					_container.children[1].children[0].children[5].innerText = v.duracion;

					items.push(_container);
				});

				$('.ctn__programas').html('');
				if (data.length > 0)
					$('.ctn__programas').append(items);
				else
				{
					var msg = $('#msg__sin-resultados').clone().removeAttr('style');
					$('.ctn__programas').append(msg);
				}
				$('.overlay-filter').hide();
				$('.ctn__section-content').css({
					height: 'auto'
				});
			}
		});
	}

	// Metodo que se encargara de hacer las peticiones ajax para los filtros
	function filtrarExtensiones()
	{
		var data			= {};
		data['cat']			= $('#primary').attr('cat');
		data['tipo']		= $('.filter-label.select').attr('rel') == undefined ? '' : $('.filter-label.select').attr('rel');
		var checkbox_list	= $('.checkbox-itm > input');

		$.each(checkbox_list, function (k, v) {
			v.checked ? data[v.id] = true : data[v.id] = null;
		});

		$.ajax({
			url: theme_path + '/ajax/filtro-extensiones.php',
			method: 'POST',
			data: data,
			beforeSend: function()
			{
				// Mostrar el efecto de cargando...
				$('.ctn__section-content').css({
					height: '573px'
				});
				$('.overlay-filter').show();
			},
			success: function(data)
			{
				// grid container
				var container = $('.ctn__facultad.hidden').get(0);
				// grid item
				var grid_item = $('.ctn__programa.hidden').get(0);

				var grid_items = [];
				var container_items = [];

				$('.ctn__grids').html('');

				$.each(data, function(tipo,extensiones) {
					var _container = $(container).clone().removeAttr('style').removeClass('hidden').get(0);
					_container.children[0].children[0].innerText = data[tipo][0].tipo_text;
					$.each(extensiones, function (key, extension) {
						var _grid_item = $(grid_item).clone().removeAttr('style').removeClass('hidden').get(0);
						// a.ctn__programa
						_grid_item.href = extension.enlace;
						// ctn__programa-image
						var style = _grid_item.children[0].children[0].style;
						var img_url = $(extension.imagen).attr('src');
						style.background = 'url("http://lorempixel.com/400/400") 50% 50% / 100% no-repeat';
						style.backgroundPosition = '50% 50%';
						style.backgroundSize = '100%';
						
						// ctn__programa-image > img
						//_container.children[0].children[0].children[0].src = img_url;
						
						// ctn__programa_top > h3
						_grid_item.children[0].children[1].innerText = extension.titulo;

						// Tipo de programa
						_grid_item.children[1].children[0].children[1].innerText = extension.tipo_text;
						// Sede
						_grid_item.children[1].children[0].children[3].innerText = extension.sede_text;
						// Intensidad horaria
						_grid_item.children[1].children[0].children[5].innerText = extension.intensidad_horaria;

						$(_container.children[1]).append(_grid_item);
					});

					container_items.push(_container);
					$('.ctn__grids').append(container_items);
				});

				if (container_items.length == 0)
				{
					var msg = $('#msg__sin-resultados').clone().removeAttr('style');
					$('.ctn__grids').append(msg);
				}

				$('.overlay-filter').hide();
				$('.ctn__section-content').css({
					height: 'auto'
				});
			}
		});
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