<div class="wmts_member_template_panel wmts_panel" data-wph-type="wmts-template">

	<!-- Template container -->
	<div class="wph_template">
	</div>
	
	<!-- Apply button-->
	<button class="wmts_get_markup">Apply Settings</button>
	<button class="wph_editor_save_trigger">Save Applied Settings</button>
	<span class="wmts_meta_key_list_button">Extended meta key list</span>
	<div class="wmts_meta_key_list">
		<em>These pseudo meta keys extend regular {{ meta_keys }} and can be used inside any input or textarea of the template.</em>
		<div>
			<span>{{post_id}}</span>
			<span>{{post_title}}</span>
			<span>{{post_link}} <em> : outputs url</em></span>
			<span>{{post_excerpt | word_count}}</span>
			<span>{{the_content}} <em> : 'the_content' filters applied</em></span>
			<span>{{content | word_count}}</span>
			<span>{{featured_image | size}} <em> eg: {{featured_image | thumbnail }}</em></span>
			<span>{{author}}</span>
		</div>
		<div>
			<span>{{author_link}} <em>: outputs anchor tag</em></span>
			<span>{{comments}} <em>: number of comments</em></span>
			<span>{{category | separator}} <em>eg: {{category |, }}</em></span>
			<span>{{category_link | separator}}</span>
			<span>{{tags | separator}}</span>
			<span>{{tags_link | separator}}</span>
			<span>{{date | format}} <em> eg: {{date | D, F j, Y }}</em></span>
			<span>{{date_modifier | format}}</span>
		</div>
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
		<span class="wmts_clearfix"></span>
	</div>
</div>