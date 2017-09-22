<?php
/**
 * Plugin Name: RWC WooCommerce Only Free Shipping to Continental US
 * Description: Only Ship Free to the Continental US
 * Author: Road Warrior Creative
 * Author URI: http://roadwarriorcreative.com/
 * Version: 1.0
 *
 * Inspired by Patrick Rauland's only ship to continental US (@BFTrick)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author		Road Warrior Creative
 * @since		1.0
 */

/**
* Only ship free to the continental US
*
* @param array $available_methods
*/
add_filter( 'woocommerce_package_rates', 'rwc_only_free_ship_to_continental_us', 10 );
function rwc_only_free_ship_to_continental_us( $available_methods ) {
	global $woocommerce;
	$excluded_states = array( 'AK','HI','GU','PR' );

	if( in_array( $woocommerce->customer->get_shipping_state(), $excluded_states ) ) {
		if (array_key_exists ( 'free_shipping' , $available_methods )) {
				 unset($available_methods['free_shipping']);
			}
	}

	return $available_methods;
}


/**
* Deprecation Notice
*/
function my_error_notice() {
	?>
	<div class="error notice">
		<p><?php _e( "With WooCommerce's 3.0 update and the addition of detailed shipping zone settings the <strong>RWC WooCommerce Only Free Shipping to Continental US</strong> plugin is no longer necessary and will not be further supported or updated. It's highly recommending that this plugin is uninstalled. Learn more about WooCommerce's shopping zones <a href='https://docs.woocommerce.com/document/setting-up-shipping-zones/' target='_blank'>here</a>.", 'my_plugin_textdomain' ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'my_error_notice' );

//* That's it, all done!