


// FOR PRICE RANGE SLIDER
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 999,
      values: [ 0, 999 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});