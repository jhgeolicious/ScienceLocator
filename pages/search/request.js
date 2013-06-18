$(document).ready(function(){

	/****************************************************************
	 * costumization                                                *
	 ****************************************************************/

	var layerstyle = {
		color: '#0000ff',
		weight: 5,
		opacity: 0.6,
		fillOpacity: 0.1,
		fillColor: '#0000ff',
	};

	var layerstylehover = {
		color: '#0000ff', 
		weight: 5,
		opacity: 0.6,
		fillOpacity: 0.5,
		fillColor: '#0000ff',
	};

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize('map');

	map_coordinates(map, $('#debug'), 'Mouse at');

	var drawing = map_draw({
		map:    map,
		button: $('input[name=area]'),
		start:  function(){ layers.clearLayers(); },
	});

	var layers = L.geoJson(null, {
		onEachFeature: function(feature, layer){
			// forward properties to layer
			layer.properties = feature.properties;

			// set default style
			layer.setStyle(layerstyle);

			// highlight result on hover
			layer.on('mouseover', function(){
				select_result(feature.properties.id, true);
			});

			// pan layer into view on click
			layer.on('click', function(){
				fit_layer(layer);
			});
		},
	}).addTo(map);

	// highlight result on hover
	$(document).on('mouseover', '#results > div', function(){
		var element = $(this), id = element.attr('tag');
		select_result(id, false);
	});

	// pan layer into view on click
	$(document).on('click', '#results > div', function(){
		var id = $(this).attr('tag');
		var layer = get_layer(id);
		fit_layer(layer);
	});

	/****************************************************************
	 * search request                                               *
	 ****************************************************************/

	function search_request(title, points)
	{
		var request = $.ajax({
			url        : 'pages/search/request.php',
			type       : 'POST',
			dataType   : 'json',
			data       : {
							title  : title  || '',
							points : points || '',
						 },
			cache      : false,
			beforeSend : function(){ message('').addClass('loading'); },
		}).done(function(json){
			message('').attr('id', 'results');
			drawing.hide();
			for(var i = 0; i < json.features.length; ++i)
				list_result(json.features[i].properties);
			layers.addData(json.features);
		}).fail(function(jqxhr){
			message('<h3>The search request failed.</h3><p>' + jqxhr.responseText + '</p>');
		}).always(function(){
			$('.loading').remove();
		});
	}

	$('input[name=submit]').click(function(){
		search_request(
			$('input[name=keywords]').val(),
			lnglat_to_array(drawing.points)
		);
	});

	function message(text)
	{
		$('.message').remove();
		return $('<div class="message">' + text + '</div>').appendTo('#side');
	}

	/****************************************************************
	 * display results                                              *
	 ****************************************************************/

	function list_result(properties)
	{
		$('#results').append('<div tag="' + (properties.id          || ''              ) + '">'
		                   + '<h3>'       + (properties.title       || 'Untitled'      ) + '</h3>'
		                   + (properties.link ? '<a href="' + properties.link + '" target="_blank">' + properties.link + '</a>' : '')
		                   + '<span>'     + (properties.date        || 'date unknown'  ) + '</span>'
		                   + (properties.description ? '<p>' + properties.description + '</p>' : '')
		                   + '</div>');
	}

	/****************************************************************
	 * select result                                                *
	 ****************************************************************/

	function select_result(id, scroll)
	{
		// get layer from id
		var layer;
		layers.eachLayer(function(i){
			if(i.properties.id == id)
				layer = i;
		});

		// get element from id
		var elements = $('#results > div');
		var element = elements.filter('[tag=' + id + ']');

		// highlight layer
		layers.setStyle(layerstyle);
		layer.setStyle(layerstylehover);

		// hightlight element
		elements.removeClass('selected');
		element.addClass('selected');

		// scroll to element
		if(scroll || false)
		{
			var margin = 10;
			var top    = element.offset().top - margin,
			    bottom = element.offset().top + element.outerHeight() + margin - $(window).height();

			if(top < $(document).scrollTop())
				$('html, body').stop().animate({ scrollTop: top }, 700);
			else if(bottom > $(document).scrollTop())
				$('html, body').stop().animate({ scrollTop: bottom }, 700);
		}
	}


	/****************************************************************
	 * helper functions                                             *
	 ****************************************************************/

	function get_layer(id)
	{
		var layer;
		layers.eachLayer(function(i){
			if(i.properties.id == id)
				layer = i;
		});
		return layer;
	}

	function fit_layer(layer)
	{
		var bounds = layer.getBounds();
		map.fitBounds(bounds, { animate : true, padding : [20, 20] });
	}

	function lnglat_to_array(lnglat)
	{
		array = [];
		for (i = 0; i < lnglat.length; ++i)
		{
			array.push([lnglat[i].lng, lnglat[i].lat]);
		}
		return array;
	}

});
