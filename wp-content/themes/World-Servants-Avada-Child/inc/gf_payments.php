<?php
$payFormID = get_field( 'payFormID', 'option' );
$regFormID = get_field( 'regFormID', 'option' );

function gf_populate_trips( $form ) {
	$tripSelectField = get_field( 'tripSelectField', 'option' );

	foreach ( $form['fields'] as &$field ) {
 
		if ( $field->type != 'select' || strpos( $field->cssClass, $tripSelectField ) === false ) {
			continue;
		}
 
		$trips = get_trips();
		asort( $trips );
 
		$choices = array();
 
		foreach ( $trips as $value => $text ) {
			$choices[] = array( 'text' => $text, 'value' => $value );
		}
 
		// update 'Select a Post' to whatever you'd like the instructive option to be
		$field->placeholder = 'Select your trip';
		$field->choices = $choices;
 
	}
 
	return $form;
}

if( !empty( $payFormID ) ) {
	add_filter( "gform_pre_render_$payFormID", 'gf_populate_trips' );
	add_filter( "gform_pre_validation_$payFormID", 'gf_populate_trips' );
	add_filter( "gform_pre_submission_filter_$payFormID", 'gf_populate_trips' );
	add_filter( "gform_admin_pre_render_$payFormID", 'gf_populate_trips' );
}


function get_trips() {
	$jATAPI = new jATAPI();

	$c = 100;
	$t = get_field( 'tripsTableName', 'option' );
	$v = get_field( 'tripsAllPubView', 'option' );
	
	$r = '/' . $t . '?maxRecords=' . $c . '&view=' . $v;

	$response = $jATAPI->request( $r );

	if ( !empty( $response->records ) ):
		foreach( $response->records as $record ):
			// SET VARS
			$recID = $record->id;
			extract( get_object_vars( $record->fields ) );

			$loc = $LOC_1[0] . ', ' . $LOC_2[0];
			$date = date( 'm/d/Y', strtotime( $Start_Date ) ) . ' - ' . date( 'm/d/Y', strtotime( $End_Date ) );

			$return[$recID] = "$loc ($date)";

		endforeach;
	else:

		$return['nope'] = 'No trips returned';

	endif;

	return $return;
}

function addPaymentsToAirtable( $entry, $form ) {
	$jATAPI = new jATAPI();

	$data = array(
		'records'	=> array(
			array(
				'fields'	=> array(
					'First_Name'			=> rgar( $entry, '14.3' ),
					'Last_Name'				=> rgar( $entry, '14.6' ),
					'Email'					=> rgar( $entry, '15' ),
					'Address'				=> rgar( $entry, '16.1' ),
					'Address_2'				=> rgar( $entry, '16.2' ),
					'City'					=> rgar( $entry, '16.3' ),
					'State'					=> rgar( $entry, '16.4' ),
					'Zip'					=> rgar( $entry, '16.5' ),
					'Amount_STR'			=> rgar( $entry, '21' ),
					'Participant_First'		=> rgar( $entry, '43.3' ),
					'Participant_Last'		=> rgar( $entry, '43.6' ),
					'Trip'					=> array( rgar( $entry, '19' ) ),
					'Registration'			=> array()
				)
			)
		)
	);

	$r = '/' . get_field( 'payTableName', 'option' );

	$response = $jATAPI->request( $r, 'post', $data );
	//var_dump($response);
}

// Check to see if the $payFormID option has been set before adding the action
if( !empty( $payFormID ) ) {
	add_action( "gform_post_submission_$payFormID", 'addPaymentsToAirtable', 10, 2 );
}


function addRegPaymentsToAirtable( $entry, $form ) {
	$jATAPI = new jATAPI();

	if( rgar( $entry, '40' ) == 1 ) {
		$data = array(
			'records'	=> array(
				array(
					'fields'	=> array(
						'First_Name'			=> rgar( $entry, '4.3' ),
						'Last_Name'				=> rgar( $entry, '4.6' ),
						'Email'					=> rgar( $entry, '8' ),
						'Address'				=> rgar( $entry, '7.1' ),
						'Address_2'				=> rgar( $entry, '7.2' ),
						'City'					=> rgar( $entry, '7.3' ),
						'State'					=> rgar( $entry, '7.4' ),
						'Zip'					=> rgar( $entry, '7.5' ),
						'Amount_STR'			=> strval( rgar( $entry, '47' ) ),
						'Trip'					=> array( rgar( $entry, '40' ) ),
						'Registration'			=> array()
					)
				)
			)
		);

		$r = '/' . get_field( 'payTableName', 'option' );

		$response = $jATAPI->request( $r, 'post', $data );
		var_dump($response);
	}
}

// Check to see if the regFormID option has been set before adding the action
if( !empty( $regFormID ) ) {
	
	add_action( "gform_post_submission_$regFormID", 'addRegPaymentsToAirtable', 10, 2 );
}
?>