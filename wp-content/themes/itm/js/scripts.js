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
		filtrarProgramas();
		evt.stopPropagation();
	});

	// Filtros de tipo de programa y metodologías
	$('.checkbox-itm > input').on('change', function(evt) {
		filtrarProgramas();
		evt.stopPropagation();
	});

	$('.input-filter input').on('keyup', function(evt) {
		var element = $(this);
		var text = element.val();
		if (text.length > 2 && evt.which <= 90 && evt.which >= 48)
		{
			var parent = $('#primary').attr('cat');
			$.ajax({
				method: "POST",
				url: admin_path + "/admin-ajax.php",
				data: {
					'action' : 'getProgramasCat',
					'parent' : parent
				},
				beforeSend: function() {
					$(".input-filter").append('<div class="loading-search"></div>');
				},
				success: function(data) {
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
			.done(function() {
				$(".loading-search").remove();
			});
		}
		evt.stopPropagation();
	});

	function autocompleteItemSelect(item)
	{
		window.location = item.url;
	}

	// Metodo que se encargara de hacer las peticiones ajax para los filtros
	function filtrarProgramas() {
		var data			= {};
		data['facultad']	= $('body').attr('class').split('category-')[2].substring(2,0);
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