<div class="wmts_guides_meta_box">
	<p>
		<span>Master MTS faster with these quick tut guides. Each guide exposes new features. Follow them in their order as they teach you increasingly advanced lessons.</span>
	</p>
	<!-- Keys -->
	<div class="wmts_guide_keys">
		<span class="wmts_guide_key" >Link cell to member post</span>
		<span class="wmts_guide_key">Display post excerpt</span>
		<span class="wmts_guide_key">Create a toolTip container</span>
		<span class="wmts_guide_key">Change LightBox content</span>
		<span class="wmts_guide_key" >Create a custom attribute</span>
		<span class="wmts_guide_key">Display ribbons based on logic</span>
	</div>
	
	<!-- Guides -->
	<div class="wmts_guides">
	
		<!-- Setting cell link to member post -->
		<div class="wmts_guide" >
			<?php
				$wmts_docum_url = plugins_url( ).'/modern-team-showcase/documentation';
			?>
			<li>
			Please note that these guides assume you are using the 'Vertical' preset with Image, Links, LightBox, Attributes and Description enabled. This standard preset requirement is in place to keep things uncomplicated. The lessons you learn will be applicable to all preset types and even any custom structures you choose build. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/1-1.png">ScreenShot</a>
			</li><li>
			To edit any showcase, we need to first bring up the showcase editor. For this, click the green button located at the top-left corner of the showcase you want to edit. Note the save button: it is the floppy disk icon at the top-right of your editor. Use it often to save your progress.<a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/1-2.png">ScreenShot</a>			</li><li>
			Now open up the 'Member Template' panel using the settings menu at the top of the editor. This panel visually represents the template of our member cells and we can use it to easily change their style, structure and content. Right now you're seeing just one element in it - the overall container of the template. Let's open it to view more elements inside. Double clicking inside it toggles its expand / contract state.			</li><li>
			Double clicking any template element will toggle its closed / expanded state. Once it is expanded, you can now view the overall container's sub elements and the keys for its settings tabs. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/1-3.png">ScreenShot</a>			</li><li>
			To achieve our goal of setting a link for our member cells, we essentially need to assign the right link to this overall container. To do so, expand it's attributes settings tab by clicking the settings tab key labelled 'Attrs'.			</li><li>
			Now, in the input field for 'Link' we will enter a key which will be replaced by the post link when the cell is being printed.			</li><li>
			You can find the list of such keys by clicking the 'Extended meta key list' at the bottom of the panel, next to the 'Apply Template' button. You can scroll up and down the editor for convenience.			</li><li>
			As you can see in the list, the key we are looking for is {{post_link}}. Let's enter it in the 'Link' input field of the overall container. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/1-4.png">ScreenShot</a>			</li><li>
			Now hit 'Apply Template' and in a few moments you'll find the showcase reloads and its member cells are printed with the modified template. Accordingly, clicking any cell will lead to its member's post.
			</li>
		</div>
	
		<!-- Showing member post excerpt -->
		<div class="wmts_guide" >
			<li>
			If you are starting with a preset showcase you'll find that the description box of the members shows text from their MTS Description meta key, which is linked to the description field in their forms. In this tut we will display their post excerpt instead.			</li><li>
			Let's open up the editor and locate the element named 'Description' inside the 'Text Container'. Depending on the preset you have loaded, the Text Container may be placed directly inside the Overall Container.			</li><li>
			Open up the 'Content' settings tab for this element. Here let's switch the {{MTS Description}} code with the appropriate code for post excerpt. You can find the code in the extended list of meta keys. It is {{post_excerpt}}. You will find that the list explains that you can also limit the number of words by entering it in this format: {{post_excerpt | 20}} <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/2-1.png">ScreenShot</a>			</li><li>
			Click 'Apply Template' and you'll find the resulting showcase displays member excerpts.
			</li><li>
			To keep things organized, you can change the name of this element from Description to Excerpt by going to its Name settings tab and entering the new name.
			</li>
		</div>

		<!-- Creating a toolTip container -->
		<div class="wmts_guide" >
			<li>
			Creating a ToolTip is made very easy with MTS. You just need to assign one of the containers to be a ToolTip container. Then you can put all the elements in it that you want in your toolTip. The ToolTip container is no different than any other regular container except it has been assigned a class of 'wmts_tooltip' in 'Class>Classes'.<a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/3-1.png">ScreenShot</a>
			</li><li>
			Let's say we want to display the Description and Attributes elements in a tooltip on mouse hover. For this we will create a new tooltip container right under the overall container and then we will place the Description and Attributes elements element inside it.
			</li><li>
			Create a new container using the 'Add Component' option at the bottom of the Overall Container. For the sake of keeping things organized, name this container 'ToolTip Container'.<a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/3-2.png">ScreenShot</a>
			</li><li>
			Using the drag icon at the top right menu of the 'Name' and 'Job Title' elements, move them to your new ToolTip container. ( Note: In case dragging elements into the container gets difficult / buggy, try creating a dummy element inside the ToolTip Container first. Then you will find dragging other elements into it will be easier. Later delete that dummy element. )<a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/3-3.png">ScreenShot</a>
			</li><li>
			Now let's turn this container into a tooltip. In the 'Class' tab of your new ToolTip Container, give this class: wmts_tooltip. Then hit 'Apply Template' and on hover you'll find the tooltip coming up as expected.
			</li>
		</div>
		
		<!-- Changing lightBox content -->
		<div class="wmts_guide" >
			<li>
			First, using the preset builder, setup a preset with the lightbox enabled. Verify this by clicking the member cells. If a lightbox opens up, we are ready to proceed with its customization. After this open up the member template editor and locate the lightbox element.			</li><li>
			The default LightBox container holds two sub containers. The first container, called Image Centering is for centering the image on the left. The second one is named Text Container and it is positioned to the right of the Image Container. If you want the Text Container to be on the left instead, just drag and drop it above the Image Centering element and hit Apply Settings.			</li><li>
			When you are adding more content to the LightBox container, preferably add it to the Text Container element. To test this out, try duplicating the Links container inside the Text Container, using the duplicate key at the top-right of the Links Container. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/4-1.png">ScreenShot</a>
			</li><li>
			If you need a lot of text appearing in the lightbox and it makes the Text Container extend downwards till below the Image Container, giving the lightbox a messy look, you can always create a new container underneath the Text Container and place your new content there. This new container should automatically span the full width of the LightBox, unless it is given some class or properties that don't allow it. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/4-2.png">ScreenShot</a>
			</li><li>
			Note to web devs: The LightBox container element is actually just like any other sub container except it has a class of wmts_lightbox automatically assigned to it. So basically you can give the wmts_lightbox class to any container in the template for it to open up as the lightbox. But your new container may require additional CSS customization to look good.
			</li>
		</div>

		<!-- Creating a custom attribute -->
		<div class="wmts_guide">
			<li>
			This topic is covered in detail <a href="http://modernteamshowcase.com/creating-an-attribute/">here</a>. There is also a tut video on the topic there, so check it out!
			</li><li>
			You can represent any information from the 'custom fields' of your member posts in your MTS showcases. If you are not familiar with WordPress custom fields please read about them <a href="https://codex.wordpress.org/Custom_Fields" target="_blank">here</a>. You can embed the custom field values into your showcase template by writing them as {{Meta Key}}, where meta key is the same as custom field key. And when the showcase is processed {{Meta Key}} will be switched by the custom field's meta value. 
			</li><li>
			Alternatively, you can instead choose to build a new MTS form / modify an existing one and add a field to it that is assigned the right Meta Key, then save the form. Now assign this form to the correct category via the 'Associated Post Terms' panel underneath. Finally, your forms will appear on the member editor pages where you can fill in their values and retrieve the value using {{Meta Key}} in your showcase.
			</li><li>
			Now let's cover the topic of where to add {{Meta Key}} to make it show up in your member cells. The presets contain attributes inside the 'Attributes' container. Double click the member template containers to open them up and explore the structure until you find 'Attributes' container, usually inside the 'Text Container'.
			</li><li>
			Now that you see the attributes such as 'Mobile', 'E-mail', you can copy them using the copy button located among the menu buttons at top-right of each element. Or you can use the 'Add Component' button at the bottom of the Attributes container.
			</li><li>
			Use the expand button from the newly added attribute element's menu or double click it to reveal its settings tab keys. It is time to configure your custom attribute. First click on the 'Name' key so we can give this element an appropriate name for the sake of keeping our template neatly organized. Give it the name 'Location' for this example.
			</li><li>
			Now open the element's 'Content' tab. Select a suitable 'Label Icon' if you wish, give it the label text 'Location' and in the value text enter: {{MTS Location}}. When the showcase cells are being printed, this code will be switched with the value of the 'MTS Location' meta key that is associated with the member posts.
			</li><li>
			We used the 'MTS Location' meta key because it has already been given a value in the dummy members. If you were creating some other custom attribute such as age or specialization you would first need to edit the form to add such a meta key and then fill in the forms on the member pages so they get the MTS Age / MTS Specialization values. After that the process is the same as here.
			</li>
		</div>
		
		<!-- Showing different ribbons based on logic -->
		<div class="wmts_guide" >
			<li>
			Some interesting background on the MTS Logic Facility is provided over here <a href="http://modernteamshowcase.com/meta-key-logic/">here</a>. Please check it out first. The example team showcase on that page shows different elements based on member meta keys. This is possible due to the MTS Logic system which toggles elements based on conditions. We can use this same system to have any element shown or hidden based on our conditions.			</li><li>
			For example, let's say we need to display different ribbons on our member cells based on their information. For this we will create multiple ribbon elements in the Members Template. Then we access their logic system via their Logic settings tab. There we first enable the logic system and then give specific conditions under which the ribbons should appear.			</li><li>
			Of course, all this requires that you have some meta key set for all the members that the logic system checks. Then we can center our logic the value of this key. For example, in the demo showcase on the Meta Key Logic page there are three ribbon elements set in the template. The first ribbon element has its content set to 'Attending', the second has 'Not Attending' and the last has 'Unconfirmed'. The logic system of the ribbons checks the value of MTS RSVP meta key for each member. And based on its value, only one of the ribbons will quality to be shown for each member.
			</li><li>
			The 'Compare to' field has two possible values: Any and All. When you are comparing with a single value, it does not matter which you select. But if you are giving multiple values to compare with, then this field has significance. You can give multiple values for comparison by separating them with the pipe symbol for eg: val1 | val2 | val3. The Any option will return true if the condition is met when the meta key value is compared with any one or more of the values. But if you set the Compare To field to 'All' then the condition must be met when comparing with all the given values before it returns true. <a target="_blank" class="wmts_screenshot fa fa-picture-o" href="<?php echo $wmts_docum_url ?>/tuts-images/6-1.png">ScreenShot</a>			</li>
		</div>

	</div>
	<em style="margin-top: 5px; display: block;">Getting stuck? View the plugin <a href="http://modernteamshowcase.com/documentation/" target="_blank">documentation here</a>. Or use <a href="http://codecanyon.net/item/modern-team-showcase-wordpress-plugin/12173695/support" target="_blank">this form</a> to get support from the author.</em>	
</div>