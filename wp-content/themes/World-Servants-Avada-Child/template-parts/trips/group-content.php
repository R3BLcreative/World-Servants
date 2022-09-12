<?
$Cost = (isset($Cost)) ? $Cost : '';
$Deposit = (isset($Deposit)) ? $Deposit : '';
?>
<tr>
	<td class="trip-table-td trip-table-location">
		<a href="<? echo $Info_Sheet[0]; ?>" target="_self" title="Details for this trip"><? echo $LOC_1[0] . ', ' . $LOC_2[0]; ?></a>
		<span class="trip-dates hide-desktop"><? echo date('m/d/Y', strtotime($Start_Date)) . ' - ' . date('m/d/Y', strtotime($End_Date)); ?></span>
		<div class="trip-actions hide-desktop hide-tablet hide-phone-land">
			<a class="fusion-button button-flat button-small button-custom button-1 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Register for this trip" href="<? echo get_field('regFormLink', 'option'); ?>?rtrip=<? echo $recID; ?>&rgroup=<? echo $g; ?>&rpay=<? echo $pay; ?>&rcost=<? echo $Cost; ?>&rdeposit=<? echo $Deposit; ?>"><span class="fusion-button-text"><i class="fas fa-edit"></i> Sign Up</span></a>
			<a class="fusion-button button-flat button-small button-custom button-2 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Details for this trip" href="<? echo $Info_Sheet[0]; ?>"><span class="fusion-button-text"><i class="fas fa-info-circle"></i> Info</span></a>
		</div>
	</td>
	<td class="trip-table-td trip-table-dates hide-tablet hide-phone">
		<? echo date('m/d/Y', strtotime($Start_Date)) . ' - ' . date('m/d/Y', strtotime($End_Date)); ?>
	</td>
	<td class="trip-table-td trip-table-btn-wrapper hide-phone-port">
		<a class="fusion-button button-flat button-small button-custom button-1 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Register for this trip" href="<? echo get_field('regFormLink', 'option'); ?>?rtrip=<? echo $recID; ?>&rgroup=<? echo $g; ?>&rpay=<? echo $pay; ?>&rcost=<? echo $Cost; ?>&rdeposit=<? echo $Deposit; ?>"><span class="fusion-button-text"><i class="fas fa-edit"></i> Sign Up</span></a>
		<a class="fusion-button button-flat button-small button-custom button-2 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Details for this trip" href="<? echo $Info_Sheet[0]; ?>"><span class="fusion-button-text"><i class="fas fa-info-circle"></i> Info</span></a>
	</td>
</tr>