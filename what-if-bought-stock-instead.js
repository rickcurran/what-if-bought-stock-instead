/**
 * Plugin Name: What If Bought Stock Instead
 * Plugin URI: https://qreate.co.uk/projects/#what-if-bought-stock-instead/
 * Description: This plugin adds a calculator that shows how much money you'd have if you bought stock instead of buying an Apple product.
 * Version: 1.0
 * Author: Rick Curran
 * Author URI: https://qreate.co.uk
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

( function($) {
	
	function calculateStocks() {
		var stock = 'apple';
		var startyear = '2004';
		var endyear = '2024';
		var cost = parseFloat( $( '#wifibsi #cost' ).val() );
		var start_cost = 60; 	// Approximate for October 2004
		var current_cost = 231; // Approximate for October 2024
			
		// Calculation is: cost / start_cost
		// e.g. $540 / $60 = 9
		
		var shares = Math.floor( cost / start_cost ); // Round down to get number of whole shares
		
		console.log( 'cost: ' + cost );
		console.log( 'shares: ' + shares );
		
		// Apple's stock has split four times in the past:
		// 2:1 in 2000
		// 2:1 in 2005
		// 7:1 in 2014
		// 4:1 in 2020
		// We're only going from 2004 for this version of the tool so we
		// adjust the amount of stocks according to the last three splits.
		
		shares = shares * 2;
		console.log( 'shares * 2: ' + shares );
		
		shares = shares * 7;
		console.log( 'shares * 7: ' + shares );
		
		shares = shares * 4;
		console.log( 'shares * 4: ' + shares );
		
		var total = shares * current_cost;
		console.log( 'total: ' + total );
		
		total = new Intl.NumberFormat( 'en-US', { style: 'decimal', currency: 'USD' }).format( total );
		console.log( 'total: ' + total );
		
		$( '#shares' ).val( shares );
		$( '#total' ).val( total );
		
	}
	
	$( 'body' ).on( 'click', '#wifibsi #calculate', function( event ) {
		calculateStocks();
		event.preventDefault();
	});

	
} )( jQuery );