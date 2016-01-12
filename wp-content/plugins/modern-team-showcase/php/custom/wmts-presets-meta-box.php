<?php $preset_parameters = get_post_meta( $post->ID, 'MTS Preset Parameters', true ); ?>
<div class="wmts_presets" data-wmts-preset-parameters="<?php if( ! empty( $preset_parameters ) ) echo htmlentities( $preset_parameters ); ?>">

	<h2 style="margin-top: 10px;">Preset Settings:</h2>
	<section>
		<span>Type:</span>
		<select class="wmts_preset_type">
			<option>Vertical</option>
			<option>Vertical Dark</option>
			<option>Vertical Round</option>
			<option>Vertical Right</option>
			<option>Wide</option>
			<option>Round</option>
			<option>Framed Round</option>
			<option>Horizontal</option>
			<option>Horizontal Round</option>
			<option>Overlay</option>
			<option>Slide Up</option>
			<option>ToolTip</option>
			<option>Table</option>
		</select>
		
		<span style="display: none;">Style:</span>
		<select  style="display: none;" class="wmts_preset_style">
			<option>Regular</option>
			<option>Round</option>
		</select>
	</section>
	
	<section>
		<span>Number of Columns: </span>
		<input class="wmts_preset_columns" type="number"> <i>Sets number of columns for laptops and larger screens. Leave empty for auto.</i>
	</section>

	<section>	
		<span>Cell Components:</span>
		<div class="wmts_preset_components">
		
			<input type="checkbox" name="wmts_preset_components" value="Image Centering" checked>
			<span>Image</span>

			<input type="checkbox" name="wmts_preset_components" value="Links" checked>
			<span>Links</span>
			
			<input type="checkbox" name="wmts_preset_components" value="Lightbox" checked>
			<span>LightBox</span>
			
			<input type="checkbox" name="wmts_preset_components" value="Ribbon">
			<span>Ribbon</span>
			
			<input type="checkbox" name="wmts_preset_components" value="Attributes">
			<span>Attributes</span>

			<input type="checkbox" name="wmts_preset_components" value="Description">
			<span>Description</span>
			
		</div>
	</section>
	
	<section class="wmts_indented wmts_description_field">
		<span>Description Content Source: </span>
		<div style=" display: inline-block;  margin-left: 10px;">
			<input type="radio" name="descp_content" value="content" checked> 
			<span> Post Content </span>
			<input type="radio" name="descp_content" value="MTS Description"> 
			<span> Form Description Field</span>
		</div>
	</section>
	
	<section class="wmts_indented wmts_description_field">
		<span>Description Word Limit:</span>
		<input class="wmts_description_limit" value="20"  type="number"> 
	</section>
	
	<section class="wmts_indented wmts_description_field">
		<span>Description Append:</span>
		<input class="wmts_description_append" value="...">  <em style="margin-left: 5px;"> text / HTML</em>
	</section>

	<section class="wmts_indented wmts_lightbox_components_section">	
		<span>LightBox components to display:</span>
		<div class="wmts_lightbox_components">

			<input type="checkbox" name="wmts_lightbox_components" value="Image Centering" checked>
			<span>Image</span>

			<input type="checkbox" name="wmts_lightbox_components" value="Links" checked>
			<span>Links</span>
			
			<input type="checkbox" name="wmts_lightbox_components" value="Attributes" checked>
			<span>Attributes</span>

			<input type="checkbox" name="wmts_lightbox_components" value="Description" checked>
			<span>Description</span>

		</div>

		<section class="wmts_indented wmts_lightbox_orientation">
			<span>LightBox Orientation: </span>
			<div style=" display: inline-block;  margin-left: 10px;">
				<input type="radio" name="wmts_lightbox_orientation" value="horizontal" checked> 
				<span>Horizontal</span>
				
				<input type="radio" name="wmts_lightbox_orientation" value="vertical"> 
				<span>Vertical </span>
			</div>
		</section>

		<section class="wmts_indented wmts_lightbox_color_theme">
			<span>LightBox Color Theme: </span>
			<div style=" display: inline-block;  margin-left: 10px;">
				<input type="radio" name="wmts_lightbox_color_theme" value="dark" checked> 
				<span>Dark</span>

				<input type="radio" name="wmts_lightbox_color_theme" value="light"> 
				<span>Light</span>
			</div>
		</section>
		
		<!-- LightBox Description Fields Begin-->
		<section class="wmts_indented wmts_lightbox_description_field">
			<span>LightBox Description Content Source: </span>
			<div style=" display: inline-block;  margin-left: 10px;">
				<input type="radio" name="wmts_lightbox_descp_content" value="content" checked> 
				<span> Post Content </span>
				
				<input type="radio" name="wmts_lightbox_descp_content" value="MTS Description"> 
				<span> Form Description Field</span>
			</div>
		</section>
		
		<section class="wmts_indented wmts_lightbox_description_field">
			<span>LightBox Description Word Limit:</span>
			<input class="wmts_lightbox_description_limit" value="40" type="number"> 
		</section>
		
		<section class="wmts_indented wmts_lightbox_description_field">
			<span>LightBox Description Append:</span>
			<input class="wmts_lightbox_description_append" value="...">  <em style="margin-left: 5px;"> text / HTML</em>
		</section>
		<!-- LightBox Description Fields End -->

	</section>
	
	<section class="wmts_indented wmts_attributes_components_section">	
		<span>Attributes components to display:</span>
		<div class="wmts_attributes_components wmts_sortable">
			<div>
				<input type="checkbox" name="wmts_attributes_components" value="Email" checked>
				<span>Email</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_attributes_components" value="Mobile" checked>
				<span>Phone</span>
			</div>
			<div>			
				<input type="checkbox" name="wmts_attributes_components" value="Location" checked>
				<span>Location</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_attributes_components" value="Website" checked>
				<span>Website</span>
			</div>		
		</div>
		<i class="fa fa-sort" style="margin-right: 5px;"></i>
		<em><strong>Tip:</strong> You can drag and sort these.</em>
	</section>
	
	<section class="wmts_indented wmts_links_components_section">	
		<span>Links to display (if available for member):</span>
		<div class="wmts_links_components wmts_sortable">
			<div>
				<input type="checkbox" name="wmts_links_components" value="Email" checked>
				<span>Email</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="LinkedIn" checked>
				<span>LinkedIn</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="Twitter" checked>
				<span>Twitter</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="Facebook" checked>
				<span>Facebook</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="GooglePlus" checked>
				<span>GooglePlus</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="Instagram" checked>
				<span>Instagram</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="Reddit" checked>
				<span>Reddit</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="YouTube" checked>
				<span>YouTube</span>
			</div>
			<div>
				<input type="checkbox" name="wmts_links_components" value="Vimeo" checked>
				<span>Vimeo</span>
			</div>
		</div>
		<i class="fa fa-sort" style="margin-right: 5px;"></i>
		<em><strong>Tip:</strong> You can drag and sort these.</em>
	</section>
	
	<section>
		<span>Enable Link to Profile:</span>
		<div class="wmts_enable_profile_link_container">
			<input type="checkbox" name="wmts_enable_profile_link" value="true" checked="checked" />
		</div>
	</section>
	
	<section>
		<span>Grayscale member image:</span>
		<div class="wmts_enable_profile_link_container">
			<input type="checkbox" name="wmts_grayscale_image" value="true" />
		</div>
	</section>

	<section>
		<span style="display: block; float: left; margin-top: 0;">Custom CSS:</span>
		<textarea class="wmts_custom_css"></textarea>
		<div class="wmts_useful_css_selectors">
			<em>List of useful CSS selectors:</em>
			<span><strong>Name:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_name{ }</span>
			<span><strong>Job Title:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_job_title{ }</span>
			<span><strong>Image Container:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_image_centering{ }</span>
			<span><strong>Description:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_description{ }</span>
			<span><strong>Attribute:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_attribute{ }</span>
			<span><strong>Link:</strong>.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] a.wmts_element[data-wph-type="link"]{ }</span>
			<br>
			<em>Add '!important' to the end of any property before the semi-color ';' if it is not working to force it <br>such as .wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_name{ font-size: 20px!important; }</em>
		</div>
	</section>
	
	<h2>Query Settings:</h2>
	
	<section>
		<span>Number of members to show: </span>
		<input class="wmts_posts_per_page" type="number">
		<em>Enter -1 to show all members, or leave empty for default max 20.</em>
	</section>
	
	<section>
		<span>Specific IDs to show: </span>
		<input class="wmts_specific_ids" type="text" />
		<em>Enter comma separated member IDs and only they will be shown.</em>
	</section>
	
	<section>	
		<span>Select Groups: </span>
		<div class="wmts_groups">
			<?php
				$terms_arr = get_terms( 'modernteamgroups' );
				if( ! count( $terms_arr ) ) echo "<em>" . __( "You have no member Groups (categories) right now." ) . "</em>";
				else{
					foreach( $terms_arr as $term ){
						echo "<input type='checkbox' name='wmts_selected_terms' value='{$term->slug}' checked /> <span>{$term->name}</span> ";
					}
				}
			?>
		</div>		
	</section>
	
	<h2>Other Settings:</h2>
	<em style="margin-left: 20px;">More customization options are available in the main editor. Please access it via the <i class="wmts_frontend_editor_trigger fa fa-cog"></i> button then go to Editor > Overall to configure your options.</em>
	
	<section>
		<span>Enable Filtering:</span>
		<div class="wmts_enable_filtering_container">
			<input type="checkbox" name="wmts_enable_filtering" value="true" />
		</div>
	</section>
	
	<section>
		<span>Enable Pagination:</span>
		<div class="wmts_enable_pagination_container">
			<input type="checkbox" name="wmts_enable_pagination" value="true" />
			<em>Set a lower number in the  'Number of members to show' option than total available posts to actually use pagination.</em>
		</div>
	</section>
	
	<section>
		<span>Enable Search:</span>
		<div class="wmts_enable_search_container">
			<input type="checkbox" name="wmts_enable_search" value="true" />
		</div>
	</section>
	
	<section>
		<span>Re-map meta keys: </span><input type="checkbox" class="wmts_remap_metas" value="remap_metas">
		<div class="wmts_remap_metas_container">
			<span>Name <input data-wmts-type="{{title}}" value="{{title}}"></span>
			<span>Job Title <input data-wmts-type="{{MTS Job Title}}" value="{{MTS Job Title}}"></span>
			<span>Image <input data-wmts-type="{{featured_image | large}}" value="{{featured_image | large}}"></span>
			<span>Telephone <input data-wmts-type="{{MTS Telephone}}" value="{{MTS Telephone}}"></span>
			<span>E-mail <input data-wmts-type="{{pretty_link | MTS E-mail | _blank}}" value="{{pretty_link | MTS E-mail | _blank}}"></span>
			<span>LinkedIn <input data-wmts-type="{{ MTS LinkedIn }}" value="{{ MTS LinkedIn }}"></span>
			<span>Facebook <input data-wmts-type="{{MTS Facebook}}" value="{{ MTS Facebook }}"></span>
			<span>Twitter <input data-wmts-type="{{ MTS Twitter }}" value="{{ MTS Twitter }}"></span>
			<span class="wmts_meta_key_list_button">Extended meta key list</span>
		</div>
	</section>
	<div class="wmts_gap"></div>
	<span class="button wmts_load_this_preset">Load Preset</span>
	<span class="button wph_editor_save_trigger button-primary">Save Showcase</span>
	<br>
	<span class="wmts_form_submit_notice" style="margin-top: 20px!important;">
	Please note this section is not the main editor. It is here for quickly loading a preset with basic configurations. For more editing options you can use the 'Main Editor'. To open it, click the <i class="wmts_frontend_editor_trigger fa fa-cog"></i> button at the top left of the grid. The 'Main Editor' can be used from the front end of your website as well. <strong>But remember:</strong> whenever you load a preset using this section, the settings of the Main Editor are reset. For support or queries you can mail the plugin author at <a href="mailto:wordpressaholic@gmail.com" style="font-weight: bold; text-decoration: none;">wordpressaholic@gmail.com</a>.
	</span>	
</div>