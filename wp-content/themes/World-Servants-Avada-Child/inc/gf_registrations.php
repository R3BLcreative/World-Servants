<?
/* ACF PRO & GRAVITY FORMS */

function addRegistrationToAirtable( $entry, $form ) {
	$jATAPI = new jATAPI();

	if( !empty( rgar( $entry, '40' ) ) ) {
		$Trip_ID = array( rgar( $entry, '40' ) );
	}else{
		$Trip_ID = '';
	}

	if( !empty( rgar( $entry, '39' ) ) ) {
		$Group_ID = array( rgar( $entry, '39' ) );
	}else{
		$Group_ID = '';
	}

	$data = array(
		'records'	=> array(
			array(
				'fields'	=> array(
					'Trip_ID'				=> $Trip_ID,
					'Group_ID'				=> $Group_ID,
					'First_Name'			=> rgar( $entry, '4.3' ),
					'Last_Name'				=> rgar( $entry, '4.6' ),
					'Birthday'				=> rgar( $entry, '5' ),
					'Gender'				=> rgar( $entry, '6' ),
					'Address'				=> rgar( $entry, '7.1' ),
					'Address_2'				=> rgar( $entry, '7.2' ),
					'City'					=> rgar( $entry, '7.3' ),
					'State'					=> rgar( $entry, '7.4' ),
					'Zip'					=> rgar( $entry, '7.5' ),
					'Shirt_Size'			=> rgar( $entry, '10' ),
					'Phone'					=> rgar( $entry, '9' ),
					'Email'					=> rgar( $entry, '8' ),
					'Passport_Name'			=> rgar( $entry, '34' ),
					'Passport_Number'		=> rgar( $entry, '35' ),
					'EC_Name'				=> rgar( $entry, '13' ),
					'EC_Relationship'		=> rgar( $entry, '14' ),
					'EC_Phone'				=> rgar( $entry, '15' ),
					'EC_Email'				=> rgar( $entry, '16' ),
					'INS_Company'			=> rgar( $entry, '18' ),
					'INS_Policy'			=> rgar( $entry, '19' ),
					'Food_Allergies'		=> rgar( $entry, '22' ),
					'Medical_Conditions'	=> rgar( $entry, '24' ),
					'Medications'			=> rgar( $entry, '26' ),
					'Tetanus_Shot'			=> rgar( $entry, '33' ),
					'Liability_Waiver'		=> true
				)
			)
		)
	);

	$r = '/' . get_field( 'regTableName', 'option' );

	$response = $jATAPI->request( $r, 'post', $data );
	//var_dump($response);
}

$regFormID = get_field( 'regFormID', 'option' );

// Check to see if the regFormID option has been set before adding the action
if( !empty( $regFormID ) ) {
	
	add_action( "gform_post_submission_$regFormID", 'addRegistrationToAirtable', 10, 2 );
}
?>