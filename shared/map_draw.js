var map_draw = function(options)
{
	var public = {};

	/****************************************************************
	 * configuration                                                *
	 ****************************************************************/
	var config = {
		button_value_start: 'Redefine Area',
		button_value_stop:  'Admit Area',
		appearence:         {
		                        color:      '#f60',
		                        opacity:     0.8,
		                        weight:      7,
		                        fillColor:  '#f60',
		                        fillOpacity: 0.3,
		                    },
	};

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
			if(public.points[public.points.length - 1] == e.latlng)
			{
				state(false);
			}
			// single click
			else
			{
				public.points.push(e.latlng);
				display(public.points);
			}
		}
	});

	// preview next point
	options.map.on('mousemove', function(e) {
		if(drawing)
			display(public.points.concat(e.latlng));
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
			public.points = [];
			options.button.addClass('pressed').val(config.button_value_stop);
			if(options.start) options.start();
		}
		else
		{
			options.button.removeClass('pressed').val(config.button_value_start);
			if(options.stop) options.stop(points);
		}
		display(public.points);
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
