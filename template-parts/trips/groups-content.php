<tr>
	<td class="trip-table-td trip-table-group">
		<? echo $Group_Name; ?>
	</td>
	<td class="trip-table-td trip-table-btn-wrapper">
		<a class="fusion-button button-flat button-small button-custom button-1 fusion-button-span-no fusion-button-default-type trip-btn" target="_self" title="Register for this trip" href="<? echo get_field( 'grpTripsLink', 'option' ); ?>?rgroup=<? echo $Group_ID; ?>&rpay=<? echo $pay; ?>"><span class="fusion-button-text"><i class="fas fa-edit"></i> View Trips</span></a>
	</td>
</tr>