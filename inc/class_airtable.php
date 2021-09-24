<?php
/**/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( !class_exists( 'jATAPI' ) ):

	class jATAPI {

		/* PROPS */
		private $apiKey;
		private $baseID;
		private $endPoint;

		public function __construct() {
			// Get ACF PRO options
			$this->apiKey 			= get_field( 'ATAPIkey', 'option' );
			$this->baseID 			= get_field( 'ATBaseID', 'option' );
			$this->endPoint			= get_field( 'ATEndPoint', 'option' );
		}

		public function request( $request, $method = 'get', $data = null ) {
			$ch = curl_init();

			$h = array(
				"authorization: Bearer $this->apiKey",
				"Content-Type: application/json"
			);

			$data_str = ( $method == 'post' ) ? json_encode( $data ) : '';

			curl_setopt_array( $ch, array(
				CURLOPT_URL				=> $this->endPoint . $this->baseID . $request,
				CURLOPT_HTTPHEADER		=> $h,
				CURLOPT_RETURNTRANSFER	=> true
			) );

			if( $method == 'post' ) {
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_str );
			}

			$exec = curl_exec( $ch );
			$err = curl_error( $ch );

			curl_close( $ch );

			$response = json_decode( $exec );

			return $response;
		}

	}

endif;
?>