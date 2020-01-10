<?php

	namespace Levy\Template\Helpers;


	/**
	 * Page titles
	 */
	function title() {
		if ( is_home() ) {
			if ( get_option( 'page_for_posts', true ) ) {
				return get_the_title( get_option( 'page_for_posts', true ) );
			} else {
				return __( 'Latest Posts', 'adamstokes' );
			}
		} elseif ( is_archive() ) {
			return get_the_archive_title();
		} elseif ( is_search() ) {
			return sprintf( __( 'Search Results for %s', 'adamstokes' ), get_search_query() );
		} elseif ( is_404() ) {
			return __( 'Not Found', 'adamstokes' );
		} else {
			return get_the_title();
		}
	}


	/**
	 * Formats the string into a well formatted phone ideal for anchor tel links. If phone number's length is less than
	 * 10 digits long, then this function just returns the phone number as is.
	 *
	 * This function only formats for US, Canada, and Mexico. It does not take into consideration other countries' phone
	 * number formats. This function will have to be adjusted to accommodate those situations.
	 *
	 *   - Replace with '-' the following symbols: <space> ( )
	 *   - Add country code
	 *
	 * @param string $tel
	 * @param string $country See https://countrycode.org/ for more info.
	 *
	 * @return string
	 */
	function get_tel_link( $tel, $country = 'us/usa' ) {
		$tel_formatted = $tel;
		$num_of_digits = preg_match_all( "/[0-9]/", $tel );
		$country_code  = '+';

		// Remove opening and closing parentheses, white spaces, periods
		$tel = str_replace( [ '(', ')', ' ', '.' ], '', $tel );

		if ( 10 == $num_of_digits ) {
			// When phone is 10 digits long, add the country code
			switch ( $country ) {
				// Canada and USA
				case 'ca/can':
				case 'us/usa':
					$country_code .= '1';
					break;

				// Mexico
				case 'mx/mex':
					$country_code .= '52';
					break;
			}

			$tel_formatted = $country_code . '-' . preg_replace( "/(\d{3})\-*(\d{3})\-*(\d{4})/", "$1-$2-$3", $tel );
		} elseif ( 10 < $num_of_digits ) {
			// When phone is longer than 10 digits, just format it
			$tel_formatted = $country_code . preg_replace( "/(\d*)\-*(\d{3})\-*(\d{3})\-*(\d{4})/", "$1-$2-$3-$4", $tel );
		}

		return $tel_formatted;
	}