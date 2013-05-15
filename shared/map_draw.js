var map_draw = function(options)
{
	var public = {};

	/****************************************************************
	 * configuration                                                *
	 ****************************************************************/
	var config = {
		button_value_start: options.button.val(),
		button_value_stop:  'I am ready',
		appearence:         {
		                        color:      '#f60',
		                        opacity:     0.8,
		                        weight:      7,
		                        fillColor:  '#f60',
		                        fillOpacity: 0.3,
		                    },
	};

	options.button.val(config.button_value_start);

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	var drawing   = false;
	var polygon   = L.polygon([]).addTo(options.map);
	public.points = [];

	/****************************************************************
	 * event                                                        *
	 ****************************************************************/

	// start or stop drawing
	options.button.click(function() {
		state();
	});

	// stop drawing
	$(document).keyup(function(e) {
		if(e.keyCode == 27)
			state(false);
	});

	// set a point or stop drawing
	options.map.on('click', function(e) {
		if(drawing)
		{
			// double click
			if(points[points.length - 1] == e.latlng)
			{
				state(false);
			}
			// single click
			else
			{
				points.push(e.latlng);
				display(points);
			}
		}
	});

	// preview next point
	options.map.on('mousemove', function(e) {
		if(drawing)
			display(points.concat(e.latlng));
	});

	/****************************************************************
	 * helpers                                                      *
	 ****************************************************************/

	function state(state)
	{
		if(typeof state === 'undefined')
			drawing = !drawing;
		else
			drawing = state;

		if(drawing)
		{
			points = [];
			options.button.val(config.button_value_stop);
			if(options.start) options.start();
		}
		else
		{
			options.button.val(config.button_value_start);
			if(options.stop) options.stop(points);
		}
		display(points);
	}

	function display(points)
	{
		options.map.removeLayer(polygon);
		polygon = L.polygon(points, config.appearence);
		polygon.addTo(options.map);
	}

	/****************************************************************
	 * public methods                                               *
	 ****************************************************************/
	public.hide = function()
	{
		options.map.removeLayer(polygon);
	}

	return public;
};
