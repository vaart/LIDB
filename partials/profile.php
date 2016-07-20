<form id="profileFrm" method="POST">
	<table>
		<tr>
			<td>Name:</td>
			<td>
				<input type="text" id="liquorName" name="liquorName">
			</td>
		</tr>	
		<tr>
			<td>Type:</td>
			<td>
				<input type="text" id="liquorType" name="liquorType">
			</td>
		</tr>
		<tr>
			<td>Age:</td>
			<td>
				<input type="number" id="liquorAge" name="liquorAge" value="0" min="0" max="99">
			</td>
		</tr>
		<tr>
			<td>Manufacturer:</td>
			<td>
				<input type="text" id="liquorManufacturer" name="liquorManufacturer">
			</td>
		</tr>
		<tr>
			<td>Country of Origin:</td>
			<td>
				<input type="text" id="liqourCountryOfOrigin" name="liqourCountryOfOrigin">
			</td>
		</tr>
		<tr>
			<td>Rating:</td>
			<td>
				<input type="number" id="liqourRating" name="liqourRating" min="1" max="10">
			</td>
		</tr>					
		<tr>
			<td colspan="2" align="center">
				<input type="button" id="profile_btn" value="Save"/>
			</td>
		</tr>

	</table>
</form>