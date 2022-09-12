<!-- REGISTRATION FORM TRIP DETAILS -->
<div class="reg-trip-details gform_wrapper gravity-theme">
	<div class="gsection">
		<h3 class="gsection_title">TRIP DETAILS</h3>
	</div>

	<p>Please check the information below to ensure that you are registering for the correct trip.</p>

	<ul>
		<?php if( !empty( $Group_Name ) ): ?>
			<li><strong>GROUP: </strong><? echo $Group_Name; ?></li>
		<?php endif; ?>
		<li><strong>LOCATION: </strong><? echo $LOC_1[0] . ', ' . $LOC_2[0]; ?></li>
		<li><strong>DATES: </strong><? echo date( 'm/d/Y', strtotime( $Start_Date ) ) . ' - ' . date( 'm/d/Y', strtotime( $End_Date ) ); ?></li>
		<? if($_GET['rpay'] == 1): ?>
			<li><strong>COST: </strong>$<? echo $Cost; ?></li>
			<li><strong>REGISTRATION FEE: </strong>$<?php echo $Deposit; ?></li>
		<? endif; ?>
	</ul>
</div>
<!-- REGISTRATION FORM TRIP DETAILS -->