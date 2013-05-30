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

	var layers = L.geoJson(null, {
		onEachFeature: function(feature, layer){
			layer.properties = feature.properties; // attach new member
			// layer.bindPopup(feature.properties.title);
			layer.setStyle(layerstyle);
			layer.on('mouseover', function(){
				select_result(feature.properties.id, true, false);
			});
		},
	}).addTo(map);

	$(document).on('mouseover', '#results > div', function(){
		var element = $(this), id = element.attr('tag');
		select_result(id, false, true);
	});

	/****************************************************************
	 * search request                                               *
	 ****************************************************************/

	var request = $.ajax({
		url        : 'pages/all/request.php',
		type       : 'POST',
		dataType   : 'json',
		cache      : false,
		beforeSend : function(){ $('#results').addClass('loading'); },
	}).done(function(json){
		$('#results').html('');
		for(var i = 0; i < json.features.length; ++i)
			list_result(json.features[i].properties);
		layers.addData(json.features);
	}).fail(function(jqxhr){
		$('#results').html('<h3>The search request failed.</h3>' + '<p>' + jqxhr.responseText + '</p>');
	}).always(function(){
		$('#results').removeClass('loading');
	});

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

	function select_result(id, scroll, shift)
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

		// shift viewport to layer
		if(shift || false)
		{
			/*
			 * this seems to not work properly
			 *
			 * map.panInsideBounds(layer.getBounds());
			 */

			if(!map.getBounds().contains(layer.getBounds()))
			{
				var center = layer.getBounds().getCenter();
				map.setView(center, map.getZoom(), { animate : true });
			}

			/*
			 * as alternative to the code above,
			 * also zoom to cover the area
			 *
			 * var bounds = layer.getBounds();
			 * map.fitBounds(bounds, { animate : true });
			 */
		}

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

			/*
			 * as alternative to the code above,
			 * scroll so that selected result is centered
			 *
			 * var center = element.offset().top - $(window).height() / 2 + element.outerHeight() / 2;
			 * $('html, body').stop().animate({ scrollTop: center }, 700);
			 */
		}
	}

});
