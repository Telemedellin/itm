<!-- Tabs -->
<div class="wph_template_settings_tab wph_original" style="display:none;">
	<!-- Tab keys -->
	<div class="wph_template_settings_tab_keys">
		<div class="wph_template_settings_tab_key" data-wph-type="Content">
			Content
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Name">
			Name
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Class">
			Class
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Attr">
			Attrs
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Transfer">
			Transfer
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Logic">
			Logic
		</div>
		<div class="wph_template_settings_tab_key" data-wph-type="Style">
			Style
		</div>
		
	</div>
	<!-- Tab boxes -->		
	<div class="wph_template_settings_tab_boxes">
		<!-- Content -->
		<div class="wph_template_settings_tab_box" data-wph-type="Content">
			<!-- Content for regular-->
			<p data-wph-type="regular_content">
				<label  class="wph_editor_label">Content: </label>
				<br>
				<textarea data-wph-type="content" placeholder="Lorem ipsum dolor {{meta key}} sit..." /></textarea>
				<br>
				<label  class="wph_editor_label">Tag: </label>
				<select data-wph-type="tag">
					<option selected>span</option>
					<option>p</option>
					<option>strong</option>
					<option>bold</option>
					<option>em</option>
					<option>a</option>
					<option>h1</option>
					<option>h2</option>
					<option>h3</option>
					<option>h4</option>
					<option>h5</option>
					<option>h6</option>
				</select>
				<select data-wph-type="tag_html">
					<option selected>div</option>
					<option>ul</option>
					<option>ol</option>
					<option>li</option>
					<option>p</option>
					<option>span</option>
					<option>a</option>
					<option>h1</option>
					<option>h2</option>
					<option>h3</option>
					<option>h4</option>
					<option>h5</option>
					<option>h6</option>
					<option>table</option>
					<option>tr</option>
					<option>td</option>
					<option>th</option>
					
				</select>
			</p>
			<!-- Content for image -->
			<p data-wph-type="image_content">
				<label  class="wph_editor_label">Source: </label><input data-wph-type="source" placeholder="{{featured_image}}" />
				<!--
				<label  class="wph_editor_label">Lazy Loading: </label><input data-wph-type="lazy_loading" value="enabled" type="checkbox" />
				-->
			</p>
			<!-- Content for link -->
			<p data-wph-type="link_content">
				<label  class="wph_editor_label">Icon: </label><input data-wph-type="link_icon" data-wph-icon="true" />
				<label  class="wph_editor_label">Text: </label><input data-wph-type="link_text" placeholder="Lorem Ipsum" />
				<label  class="wph_editor_label">URL: </label><input data-wph-type="link_url" placeholder="{{MTS Website}}" />
			</p>
			<!-- Content for video -->
			<p data-wph-type="video_content">
				<label  class="wph_editor_label">Media Link: </label><input data-wph-type="video_link" placeholder="{{MTS YouTube}}" />
			</p>
			<!-- Content for attribute -->
			<div data-wph-type="attribute_content">
				<!-- Label -->
				<p>
					<span>Label icon: </span> <input data-wph-type="label_icon" data-wph-icon="true" />
				</p>
				<p>
					<span>Label text: </span> <input data-wph-type="label_text" /> 
				</p>
				<!-- Value -->
				<p>
					<span>Value text: </span> <input  data-wph-type="value_text" />
				</p>
				<p>
					<span>Value icon: </span> <input data-wph-type="value_icon" data-wph-icon="true" />
				</p>
			</div>

		</div>
		<!-- Name -->
		<div class="wph_template_settings_tab_box" data-wph-type="Name">
			<p>
				<label  class="wph_editor_label">Give a name: </label><input data-wph-type="name" placeholder="Custom Name" />
			</p>
		</div>
		<!-- Custom class -->
		<div class="wph_template_settings_tab_box" data-wph-type="Class">
			<p>
				<label  class="wph_editor_label">Add custom class: </label><input data-wph-type="classes" placeholder="custom_class_a custom_class_b ..." />
			</p>
		</div>
		<!-- Custom attributes -->
		<div class="wph_template_settings_tab_box" data-wph-type="Attr">
			<!-- Attrs -->
			<p>
				<label  class="wph_editor_label">Add custom attrs: </label><input data-wph-type="attrs" placeholder="data-meta='{{meta key}}'...  " />
			</p>
			<!-- Link -->
			<p data-wph-toggle="link">
				<label  class="wph_editor_label">Link: </label><input data-wph-type="link" placeholder='{{post_link}} / lightbox' />
			</p>
			<!-- Target -->
			<p>
				<label  class="wph_editor_label">Target: </label>
				<select data-wph-type="target">
					<option value=''>Disabled</option>
					<option selected>_blank</option>
					<option>_self</option>
					<option>_parent</option>
					<option>_top</option>
				</select>
			</p>
			<!-- Alt -->
			<p class="wph_template_set_alt">
				<label  class="wph_editor_label">Alt: </label><input data-wph-type="alt" placeholder='{{ featured_image | alt }}' />
			</p>			
		</div>
		
		<!-- Logic -->
		<div class="wph_template_settings_tab_box" data-wph-type="Logic">
		
			<!-- Enable -->	
			<p>
				<label class="wph_editor_label">Enable Logic</label>
				<select data-wph-type="enable_logic">
					<option>No</option>
					<option>Yes</option>
				</select>
			</p>
		
			<!-- Initial State -->	
			<p>
				<label class="wph_editor_label">Initial state</label>
				<select data-wph-type="initial_state">
					<option>Show</option>
					<option>Hide</option>
				</select>
			</p>
		
			<!-- Meta Key -->
			<p>
				<label class="wph_editor_label">Meta key</label><input data-wph-type="meta_key" placeholder="{{meta key}}">
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
			
			<!-- Comparison -->
			<p>
				<label class="wph_editor_label">Compared to</label>
				<select data-wph-type="comparison">
					<option>Any</option>
					<option>All</option>
				</select>
			</p>

			<!-- Value -->	
			<p>
				<label class="wph_editor_label">Value(s)</label><input data-wph-type="value" placeholder="value 1 | value 2">
			</p>
			
			<!-- Action -->	
			<p>
				<label class="wph_editor_label">Action</label>
				<select data-wph-type="action">
					<option>Show</option>
					<option>Hide</option>
				</select>
			</p>
			
		</div>
		
		<!-- Import / Export -->
		<div class="wph_template_settings_tab_box" data-wph-type="Transfer">
			<textarea class="wph_editor_transfer_box"></textarea>
			<button class="wph_editor_template_import">Import</button>
			<button class="wph_editor_template_export">Export</button>
		</div>
		
		<!-- Style -->
		<div class="wph_template_settings_tab_box" data-wph-type="Style">
		
			<div class="wph_half">
				<p>
				<label  class="wph_editor_label">Font size: </label><input data-wph-type="font-size" style="width:50px;"/>
				</p>
				<p>
				<label  class="wph_editor_label">Bg color: </label><input data-wph-type="background-color" data-wph-spectrum="true"/>
				</p>
				<p>
				<label  class="wph_editor_label">Font color: </label><input data-wph-type="color"  data-wph-spectrum="true"/>
				</p>
				<p>
				<label  class="wph_editor_label">Border color: </label><input data-wph-type="border-color" data-wph-spectrum="true"/>
				</p>
			</div>

			<div class="wph_half">
				<p>
				<label  class="wph_editor_label">Line height: </label><input data-wph-type="line-height" style="width:50px;"/>
				</p>
				<p>
				<label  class="wph_editor_label">Bg color hover: </label><input data-wph-type="hover-background-color" data-wph-spectrum="true"/>
				</p>
				<p>
				<label  class="wph_editor_label">Font color hover: </label><input data-wph-type="hover-color"  data-wph-spectrum="true"/>
				</p>
				<p>
				<label  class="wph_editor_label">Border color hover: </label><input data-wph-type="hover-border-color" data-wph-spectrum="true"/>
				</p>
			</div>
			<p>
				<label  class="wph_editor_label">Mouse idle CSS: </label><textarea data-wph-type="css" placeholder="prop: style; ..."></textarea>
			</p>
			<p>
				<label  class="wph_editor_label">Mouse hover CSS: </label><textarea data-wph-type="hover-css" placeholder="prop: style; ..."></textarea>
			</p>
			
		</div>
		
	</div>
	
</div>