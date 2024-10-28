<?php
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

/*
 * JAVASCRIPT
 */
add_action( 'wp_enqueue_scripts', 'wifibsi_js' );
function wifibsi_js() {
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'wifibsi_js', plugin_dir_url( __FILE__ ) . '/what-if-bought-stock-instead.js', array( 'jquery' ), '1.0', true );
}

/*
 * SHORTCODE
 */
function wifibsi_shortcode_func( $atts ) {
    $atts = shortcode_atts( array(
		'stock' => 'apple',
		'startyear' => '2004',
		'endyear' => '2024',
	), $atts, 'wifibsi' );


    $stock = sanitize_text_field( strip_tags( $atts[ 'stock' ] ) );
    $startyear = sanitize_text_field( strip_tags( $atts[ 'startyear' ] ) );
    $endyear = sanitize_text_field( strip_tags( $atts[ 'endyear' ] ) );

    $wifibsi_data = '<div id="wifibsi">';
        $wifibsi_data .= '<dl style="display:none;">';
            $wifibsi_data .= '<dt class="data-stock">'      . $stock . '</dt>';
            $wifibsi_data .= '<dd class="data-startyear">'  . $startyear . '</dd>';
            $wifibsi_data .= '<dd class="data-endyear">'    . $endyear . '</dd>';
        $wifibsi_data .= '</dl>';
        $wifibsi_data .= '<form>';
        $wifibsi_data .= '<fieldset style="padding:1rem;background-color:#eee;border-radius:10px;border:none;">';
        $wifibsi_data .= '<legend style="font-size:1.4rem;font-weight:bold;padding:0.75rem;background-color:#ccc;border-radius:10px;line-height:1;">What if I bought ' . ucfirst( $stock ) . ' stock instead?</legend>';
        $wifibsi_data .= '<p>What if instead of buying that ' . ucfirst( $stock ) . ' product in ' . $startyear . ' you had bought stock in the company instead? ';
        $wifibsi_data .= 'Enter the price you paid in ' . $startyear . ' for the product you bought to see how much money the stock would be worth in ' . $endyear . ':</p>';
    
        $wifibsi_data .= '<div style="padding: 6px;background-color:#efefef;border-radius:6px;">';
            $wifibsi_data .= '<label for="cost">Cost of product in 2004</label><div style="display:flex;align-items:center;"><span style="font-weight: bold; padding-right: 4px; font-size: 1.5rem;">$</span><input type="number" id="cost" name="cost" value="" placeholder="Enter cost..."></div>';
        $wifibsi_data .= '</div>';
        
        $wifibsi_data .= '<div style="padding: 6px;background-color:#efefef;border-radius:6px;margin-top:1rem;margin-bottom:1rem;">';
            $wifibsi_data .= '<label for="shares" style="">Amount of shares you’d have today</label><div style="display:flex;align-items:center;"><input type="text" id="shares" name="shares" value="0" placeholder=":)" style="background-color:#fbfbfb;border:none;" tabindex="-1" readonly></div>';
        $wifibsi_data .= '</div>';
        
        $wifibsi_data .= '<div style="padding: 6px;background-color:#efefef;border-radius:6px;margin-top:1rem;margin-bottom:1rem;">';
            $wifibsi_data .= '<label for="total" style="">Value of those shares today</label><div style="display:flex;align-items:center;"><span style="font-weight: bold; padding-right: 4px; font-size: 1.5rem;">$</span><input type="text" id="total" name="total" value="0" placeholder=":)" style="background-color:#fbfbfb;border:none;" tabindex="-1" readonly></div>';
        $wifibsi_data .= '</div>';
    
        $wifibsi_data .= '<input type="submit" id="calculate" value="Calculate">';
    
        $wifibsi_data .= '<p style="margin-top:2rem;font-size:0.75rem;">How is this calculated? Using approximate data from historical stock prices sources such as <a href="https://finance.yahoo.com/quote/AAPL/history/" target="_blank">Yahoo Finance</a> and <a href="https://www.digrin.com/stocks/detail/AAPL/price" target="_blank">Digrin</a>.</p>';
        $wifibsi_data .= '<ul style="margin-left:1.5rem;font-size:0.75rem;">';
        $wifibsi_data .= '<li>In October 2004 the cost of 1x Apple share was approximately $60</li>';
		$wifibsi_data .= '<li>In October 2024 the cost of 1x Apple share is approximately $231</li>';
		$wifibsi_data .= '<li>The cost of the product entered is divided by the 2004 amount to give us a number of shares, this is rounded down to get a whole number of shares for simplicity</li>';
		$wifibsi_data .= '<li>The stock split three times between 2004 and 2024, 2:1 in 2005, 7:1 in 2014 and 4:1 in 2020, so the amount of stocks is adjusted based on these splits to get the total amount for today.</li>';
		$wifibsi_data .= '</ul>';
    
        $wifibsi_data .= '</fieldset>';
        

        $wifibsi_data .= '</form>';
    $wifibsi_data .= '</div>';
	return $wifibsi_data;
}

add_shortcode( 'wifibsi', 'wifibsi_shortcode_func' );

?>