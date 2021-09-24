<div class="trip-record">
	<div class="trip-dates">
		<? echo date( 'm/d/Y', strtotime( $Start_Date ) ) . ' - ' . date( 'm/d/Y', strtotime( $End_Date ) ); ?>
	</div>
	<div class="trip-cost">$<? echo $Cost; ?></div>
	<div class="trip-actions">
		<a class="fusion-button button-flat button-small button-custom button-1 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Register for this trip" href="<? echo get_field( 'regFormLink', 'option' ); ?>?rtrip=<? echo $recID; ?>&rpay=<? echo $pay; ?>&rcost=<? echo $Cost; ?>&rdeposit=<? echo $Deposit; ?>"><span class="fusion-button-text"><i class="fas fa-edit"></i> Sign Up</span></a>
	</div>
</div>