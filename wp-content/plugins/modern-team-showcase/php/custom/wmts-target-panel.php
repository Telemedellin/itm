
<div class="wmts_target_panel">
	<p>
		<em>Through this panel you can create target groups consisting of specific members who fulfil a meta key criteria set by you. Then, in the template section you can create templates that are specifically aimed at these target groups.</em>
	</p>
	<!-- Meta Key -->
	<p>
		<label class="wph_editor_label">Meta Key</label><input data-wph-type="meta_key">
	</p>

	<!-- Relationship -->
	<p>
		<label class="wph_editor_label">Condition</label>
		<select data-wph-type="condition">
			<option>Equal to</option>
			<option>Unequal to</option>
			<option>Greater than</option>
			<option>Less than</option>
			<option>Is set</option>
			<option>Is not set</option>
			<option>Is true</option>
			<option>Is false</option>
		</select>
	</p>

	<!-- Value -->	
	<p>
		<label class="wph_editor_label">Compare to value</label><input data-wph-type="value">
	</p>

	<!-- Name -->	
	<p>
		<label class="wph_editor_label">Name this group</label><input data-wph-type="name" value="All">
	</p>
	
	<!-- Create -->	
	<p>
		<button class="wph_editor_create_target_group">Create Target Group</button>
	</p>
	
	<!-- Priority -->	
	<p>
		<label class="wph_editor_label" style="width: 100%;">Sortable List of Targets (by priority high to low):</label>
	</p>
	
	<div class="wph_editor_target_priority_list">
		<div class="wph_editor_target_priority_item">
			<span data-wph-label="All">All</span><i class="fa fa-times-circle" data-wph-type="delete"></i>
		</div>		
	</div>


</div>