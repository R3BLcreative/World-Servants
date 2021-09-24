<?php
/**/


/**/
function show_trips( $atts, $content = null ) {
	global $post;

	extract( shortcode_atts( array(
		'c'			=> 100,
		'type'		=> 'table'
	), $atts ) );

	$jATAPI = new jATAPI();

	$pay = 1;
	$t = get_field( 'tripsTableName', 'option' );
	$v = get_field( 'tripsPubView', 'option' );
	$gt = get_field( 'grpTableName', 'option' );
	$gv = get_field( 'grpViewName', 'option' );
	
	$r = '/' . $t . '?maxRecords=' . $c . '&view=' . $v;

	if( !empty( get_field( 'airtable_location_ids' ) ) ) {
		
		$iter = count( get_field( 'airtable_location_ids' ) );
		
		if( have_rows( 'airtable_location_ids', $post->ID ) ) {
			$r .= "&filterByFormula=OR%28";
			
			while( have_rows( 'airtable_location_ids', $post->ID ) ) {
				the_row();
				$iter--;

				$l = get_sub_field( 'location_id' );
				$r .= "%7BLOC_ID%7D%20%3D%20%27$l%27";

				if( $iter != 0 ) {
					$r .= "%2C%20";
				}
			}

			$r .= "%29";
		}
	}

	$response = $jATAPI->request( $r );
	//var_dump($response);

	if ( !empty( $response->records ) ):
		ob_start();

		include get_stylesheet_directory() . '/template-parts/trips/' . $type . '-header.php' ;

		foreach( $response->records as $record ):
			// SET VARS
			$recID = $record->id;
			
			extract( get_object_vars( $record->fields ) );

			include get_stylesheet_directory() . '/template-parts/trips/' . $type . '-content.php' ;

		endforeach;
		
		include get_stylesheet_directory() . '/template-parts/trips/' . $type . '-footer.php' ;

		$output = ob_get_contents();
		ob_end_clean();
	else:
		$output = '<div class="trips-none">There are no trips available at this time.</div>';
	endif;

	return $output;
}

add_shortcode( 'trips', 'show_trips' );


/**/
function groups( $atts, $content = null ) {
	global $post;

	extract( shortcode_atts( array(
		'c'			=> 100
	), $atts ) );

	$jATAPI = new jATAPI();

	$t = get_field( 'grpTableName', 'option' );
	$v = get_field( 'grpViewName', 'option' );
	
	$r = '/' . $t . '?maxRecords=' . $c . '&view=' . $v;

	$response = $jATAPI->request( $r );

	if ( !empty( $response->records ) ):
		ob_start();

		include get_stylesheet_directory() . '/template-parts/trips/groups-header.php' ;

		foreach( $response->records as $record ):
			$Enable_Payment = false; // Reset this var just in case it isn't set in base
			extract( get_object_vars( $record->fields ) );

			if( $Enable_Payment == true ) {
				$pay = 1;
			}else{
				$pay = 0;
			}

			include get_stylesheet_directory() . '/template-parts/trips/groups-content.php' ;

		endforeach;
		
		include get_stylesheet_directory() . '/template-parts/trips/groups-footer.php' ;

		$output = ob_get_contents();
		ob_end_clean();
	else:
		$output = '<div class="trips-none">There are no trips available at this time.</div>';
	endif;

	return $output;
}

add_shortcode( 'groups', 'groups' );


/**/
function group_trips( $atts, $content = null ) {
	global $post;

	extract( shortcode_atts( array(
		'c'	=> 100
	), $atts ) );

	$jATAPI = new jATAPI();

	$g = $_GET['rgroup'];
	$pay = $_GET['rpay'];
	$t = get_field( 'tripsTableName', 'option' );
	$v = get_field( 'grpTripsPubView', 'option' );
	
	$r = '/' . $t . '?maxRecords=' . $c . '&view=' . $v . "&filterByFormula=%7BGroups%7D%20%3D%20%27$g%27";

	$response = $jATAPI->request( $r );

	if ( !empty( $response->records ) ):
		ob_start();

		include get_stylesheet_directory() . '/template-parts/trips/group-header.php' ;

		foreach( $response->records as $record ):
			// SET VARS
			$recID = $record->id;
			
			extract( get_object_vars( $record->fields ) );

			include get_stylesheet_directory() . '/template-parts/trips/group-content.php' ;

		endforeach;
		
		include get_stylesheet_directory() . '/template-parts/trips/group-footer.php' ;

		$output = ob_get_contents();
		ob_end_clean();
	else:
		$output = '<div class="trips-none">There are no trips available at this time.</div>';
	endif;

	return $output;
}

add_shortcode( 'gtrips', 'group_trips' );


function sc_download_buttons( $atts, $content = null ) {
	global $post;

	extract( shortcode_atts( array(
		'c'	=> 100
	), $atts ) );

	if( have_rows( 'info_sheets' ) ) {
		ob_start();

		while( have_rows( 'info_sheets' ) ) {
			the_row();

			include get_stylesheet_directory() . '/template-parts/download-button.php';
		}

		return ob_get_clean();
	}
}
add_shortcode( 'download-buttons', 'sc_download_buttons' );
?>