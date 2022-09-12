<?php
$groupFormID = get_field( 'groupFormID', 'option' );

function addGroupToAirtable( $entry, $form ) {
	$jATAPI = new jATAPI();

	$data = array(
		'records'	=> array(
			array(
				'fields'	=> array(
					'Group_Name'			=> rgar( $entry, '4' )
				)
			)
		)
	);

	$r = '/' . get_field( 'grpTableName', 'option' );

	$response = $jATAPI->request( $r, 'post', $data );
	// var_dump($response);
}

// Check to see if the $groupFormID option has been set before adding the action
if( !empty( $groupFormID ) ) {
	add_action( "gform_post_submission_$groupFormID", 'addGroupToAirtable', 10, 2 );
}
?>