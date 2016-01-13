<div class="wmts_overall_settings_panel wmts_panel" data-wph-type="wmts-overall-settings">

	<p class="wph_editor_p">
		<label class="wph_editor_label">Device specific settings</label>
		<span class="wmts_select_device">
			<i class="fa fa-desktop wmts_selected_device" data-wmts-device="desktop"></i>
			<i class="fa fa-laptop" data-wmts-device="laptop"></i>
			<i class="fa fa-tablet fa-rotate-90" data-wmts-device="tabletLandscape"></i>
			<i class="fa fa-tablet" data-wmts-device="tablet"></i>
			<i class="fa fa-mobile fa-rotate-90" data-wmts-device="mobileLandscape"></i>
			<i class="fa fa-mobile" data-wmts-device="mobile" ></i>
		</span>
	</p>
	
	<div class="wmts_device_settings">
	
		<p class="wph_editor_p">
			<label class="wph_editor_label">Breakpoint (min width)</label>
			<input data-wph-type="breakpoint" type="number">
		</p>
	
		<p class="wph_editor_p">
			<label class="wph_editor_label">Cell spacing</label>
			<input data-wph-type="cellSpace" type="number">
		</p>
			
		<p class="wph_editor_p">
			<label class="wph_editor_label">Columns</label>
			<input data-wph-type="columns" type="number">
		</p>
		
		<p class="wph_editor_p">
			<label class="wph_editor_label">Base font size</label>
			<input data-wph-type="fontSize" type="number">
		</p>
		
		<p class="wph_editor_p">
			<label class="wph_editor_label">Cell height calculation</label>
			<select data-wph-type="height_calc" type="number" data-wph-defaultSelected= "Flexible">
				<option selected value="Flexible" >Flexible (depends on amount of content)</option>
				<option value="Aspect based" >Aspect Based (depends on given aspect ratio)</option>
			</select>
		</p>
		
		<p class="wph_editor_p">
			<label class="wph_editor_label">Ratio width:height</label>
			<input data-wph-type="width" type="number">
			<span style="margin: 0 5px;"> : </span>
			<input data-wph-type="height" type="number">
		</p>

		<p class="wph_editor_p">
			<label  class="wph_editor_label">Device specific CSS: </label>
			<textarea data-wph-type="css"></textarea>
		</p>

		<p class="wph_editor_p" style="margin-top: 0;">
			<label class="wph_editor_label">Apply above CSS to</label>
			<select data-wph-type="apply_css_to" data-wph-defaultSelected="this_and_lower">
				<option value="this_and_lower" selected>This device and lower</option>
				<option value="this_and_higher">This device and higher</option>
				<option value="only_this">Only this device</option>
			</select>
		</p>

	</div>
	
	<p class="wph_editor_p" style="margin-top: 0;">
		<label class="wph_editor_label">Layout mode</label>
		<select data-wph-type="layoutMode">
			<option value="masonry" selected >Masonry</option>
			<option value="fitRows">Fit rows</option>
			<option value="vertical">Vertical</option>
		</select>
	</p>

	<p class="wph_editor_p">
		<label  class="wph_editor_label">General CSS: </label>
		<textarea data-wph-type="general_css" style="vertical-align: middle; height: 100px; width: 250px;"></textarea>
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Cache for speed</label>
		<select data-wph-type="cache" data-wph-defaultSelected="Off">
			<option>On</option>
			<option selected>Off</option>
		</select>
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Cache purge time</label>
		<input data-wph-type="cache_purge_time" type="number" style="max-width: 70px;" placeholder="2.5">
		<span>days</span>
		<!--
		<span style="margin-right: 5px;">Every</span><input data-wph-type="cache_purge_time" type="number" placeholder="3"><span style="margin-left: 5px;">days</span>
		-->
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Filtering</label>
		<select data-wph-type="filtering" data-wph-defaultSelected="Disabled">
			<option selected>Disabled</option>
			<option>Enabled</option>
		</select>
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Filter by category / {{meta key}} </label>
		<input data-wph-type="filtering_key" placeholder="category / {{Meta Key}}" value="category">
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Filter 'ALL' label (text/ HTML)</label>
		<input data-wph-type="filtering_all" value="All">
	</p>
	
	<div class="wph_editor_p">
		<label class="wph_editor_label" style="width: 100%;">Filter Items Order and Labels (text/ HTML)</label>
		<!--
		<input type="hidden" data-wph-type="filtering_details" value='[{"name":"Marketing","content":"Marketing","live":true},{"name":"Finance","content":"Finances","live":true}]' />
		-->
		<input type="hidden" data-wph-type="filtering_details" value='' />
		<div class="wmts_filtering_details" data-wmts-message="<div class='wmts_filtering_reset_notice'>The Data for this section needs to be reset. Every time you change the query, or the input value for 'Filter by ', the data for this section will need to be reset. Please click 'Apply Settings' once to fetch the new data.</div>">
			<!-- will be filled by JS wmts_filtering_details( ) -->
			<div class='wmts_filtering_reset_notice'>The Data for this section needs to be reset. Every time you change the query, or the input value for 'Filter by ', the data for this section will need to be reset. Please click 'Apply Settings' once to fetch the new data.</div>
		</div>
	</div>
	
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Search</label>
		<select data-wph-type="search" data-wph-defaultSelected="Disabled">
			<option selected>Disabled</option>
			<option>Enabled</option>
		</select>
	</p>
	<!--
	<p class="wph_editor_p">
		<label class="wph_editor_label">Search Alignment</label>
		<select data-wph-type="search_alignment" data-wph-defaultSelected="Right">
			<option selected>Right</option>
			<option>Center</option>
			<option>Left</option>
		</select>
	</p>
	-->
	<p class="wph_editor_p" style="display: none;">
		<label class="wph_editor_label">Search Input Placeholder</label>
		<input data-wph-type="search_input_placeholder" value="Member Name">
	</p>
	
	<p class="wph_editor_p" style="display: none;">
		<label class="wph_editor_label">All Departments</label>
		<input data-wph-type="search_all_departments" value="All Departments" />
	</p>
	
	<p class="wph_editor_p" style="display: none;">
		<label class="wph_editor_label">Search Button Label</label>
		<input data-wph-type="search_button_label" value="Search">
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Pagination</label>
		<select data-wph-type="pagination" data-wph-defaultSelected="Disabled">
			<option selected>Disabled</option>
			<option>Enabled</option>
		</select>
	</p>

	<p class="wph_editor_p" style="display: none;">
		<label class="wph_editor_label">Pagination Type</label>
		<select data-wph-type="pagination_type" data-wph-defaultSelected="numbered">
			<option value="numbered" selected>Numbered Buttons</option>
			<option value="load_more" >Load More Button</option>
			<!--
			<option value="on_scroll" >Load More on Scroll</option>
			-->
		</select>
	</p>
	
	<p class="wph_editor_p" style="display: none;">
		<label class="wph_editor_label">Load More Text</label>
		<input data-wph-type="load_more_text" value="Load More">
	</p>

	<p class="wph_editor_p">
		<label class="wph_editor_label">Wait for images</label>
		<select data-wph-type="images" data-wph-defaultSelected="Yes">
			<option selected>Yes</option>
			<option>No</option>
		</select>
	</p>
	
	<p class="wph_editor_p">
		<label class="wph_editor_label">Wait for fonts</label>
		<input data-wph-type="fonts" placeholder="Raleway, Open Sans">
	</p>	

	<p class="wph_editor_p" style="margin-top: 20px;">
		<button class="wmts_get_markup">Apply Settings</button>
		<button class="wph_editor_save_trigger">Save Applied Settings</button>
	</p>

</div>