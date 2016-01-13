<em style="padding: 10px 0; display: block; font-size: 18px;">In case these FAQs are unable to answer your queries please use the <a href="http://codecanyon.net/item/modern-team-showcase-wordpress-plugin/12173695/support" target="_blank">support form</a> to contact the author.</em>

<div class="wmts_faqs">

	<!-- 404 -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		I am getting 404 Not Found errors on the bio pages. How do I fix it?
	</div>
	<div class="wmts_faqs_a">
		This is likely a simple matter of refreshing your permalink settings. Just go to your WordPress Admin Dashboard > Settings > Permalinks. On that ‘Permalinks Settings’ page click on save changes. This will refresh your permalinks. If this does not fix the problem, please contact me via the <a href="http://codecanyon.net/item/modern-team-showcase-wordpress-plugin/12173695/support" target="_blank">support form</a>.
	</div>

	<!-- Change member order -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		How do I change the order of the members in my showcase?
	</div>
	<div class="wmts_faqs_a">
		Member order is by default based on the value entered into the 'Member Order' form of the members. Just go to their individual editor pages fill in the values you want. These values do not have to be unique. They can even represent priorities such as all members with a value of 1 will be displayed before members with order value 2. Or you could give each member an individual order value for more control over their ordering.<br>
		You can also give your members alphabetic ordering or order based on some custom field (meta value). See the next question for those.
	</div>

	<!-- Alphabetic order / Meta key order -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		How do I alphabetically order my members? And how do I order them based on a specific meta key / custom field?
	</div>
	<div class="wmts_faqs_a">
		To alphabetically order your members you need to use the Main Editor. Please remember, whenever you use the Load New Preset section the settings in the Main Editor will be wiped clear so you will need to re-do them. <br>
		Open the Main Editor using the green button at the top left of your showcase. In the Query panel of the editor that opens up, you will find an input field labeled 'Additional query args'. Enter the following into it: orderby=title<br>
		In case you need to order by a meta key, you can use this code: orderby=meta_value&meta_key=Meta Key where the word Meta Key is to be replaced by your meta field / custom field name.<br>
		Lastly, if you want the members to be ordered using the Order field provided by the plugin on the member pages, and you want that members who have the same order number should be arranged alphabetically, then you could use this code in the additonal args field: orderby=meta_value_num title&meta_key=MTS Order
	</div>

	<!-- image resolution -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		How do I change the resolution of the member images in my showcase? 
	</div>
	<div class="wmts_faqs_a">
	1. Open the front end editor using the little green button at the top left of the grid. <br>
	2. Now click on the 'Member Template' button of its top menu. Now double click on the Overall template box, or click its '+' sign to expand it. <br>
	3. Among its child elements you will find 'Image Centering'. Expand it (+/double click) as well and you will reach the actual Image element we want to adjust.<br>
	4. Click on its it's 'content' settings tab to open it. You will find a pattern like {{featured_image | medium}}. You need to replace that last word that appears after the pipe (|) symbol (in this example medium) to any other image size supported by your site such as ​'​full'​, 'thumbnail', 'medium', or a custom image size name that is supported.<br>
	5. Hit 'Apply Settings' at the bottom of the showcase editor. Once the changes are applied click on 'Save Applied Settings'.<br>
	</div>

	<!-- image size -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		How do I change the featured image size of the member cells in my showcase?
	</div>
	<div class="wmts_faqs_a">
	<strong>Please do not mix up instructions below!</strong> There are different instructions based on the preset type you are using:<br>
	<strong>Instructions for the presets - Overlay, ToolTip and SlideUp: </strong> These presets have their entire cell sizes controlled by aspect ratio. Using the aspect ratio (that you can change) the height of the cell is calcuated on the basis of the width available for the cell. The image element will exand or contract to occupy the entire space available in the cell. Following are the steps:<br>
	1. Open the front end editor using the little green button at the top left of the grid. <br>
	2. Now open its Overall tab. See the white colored 'Device specific settings' section. There you will find an option called 'Height Calculation'. If it's value is set to 'Aspect Based' then we are on the right track otherwise you need to be following the other set of instructions below.<br>
	3. Change the 'Ratio' setting and hit the 'Apply Settings' button at the bottom of the editor.<br>
	4. Please keep in mind that you can select various device tabs at the top of this panel and you should set the aspect ratio you feel is right for each one of the devices tabs.
	5. Hit 'Apply Settings' at the bottom of the showcase editor. Once you settle on the settings that you like, and they have been applied, click on 'Save Applied Settings'.
	<br>
	<strong>Instructions for the presets - Vertical, Vertical Dark and Vertical Right: </strong>Now we will cover the steps needed to change the image height in the case of presets that are <em>not</em> based on the aspect ratio sizing system. In the case of theses presets the height of the cell is controlled simply by the amount of content available in the cell.  Following are the steps: <br>
	1. Open the Editor > Overall panel as described above.<br>
	2. In the 'CSS' section you need to add the following code:<br>
	.wmts_container[data-wph-post-id="<?php echo $post->ID; ?>"] .wmts_image_centering { height: 300px; } <br> 3. You need to change the value 300 to whatever you feel is fit for the current device group.<br>
	4. Using the 'Device specific settings' section at the top of this panel you can cycle through the showcase settings on various device sizes. So add the CSS code for other device groups as well if you want to set different heights for the featured images for the different device groups.
	5. Hit 'Apply Settings' at the bottom of the showcase editor. Once you settle on the settings that you like, and they have been applied, click on 'Save Applied Settings'.
	<br>
	</div>

	<!-- Custom bio page URLs -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		How do I change the URLs to the member bio pages? I want to link member cells to custom bio pages that I created.
	</div>
	<div class="wmts_faqs_a">
	Please follow these steps:<br>
	1. In each of the member pages you will find a panel called 'Custom Fields'<br>
	2. In this panel you just need to add a new custom field. Basically on the left side you enter a key, preferably like MTS Custom Link. And on the right side add its value, ie the entire URL for the member bio page like http://mywebsite.com/customurl <br>
	3. Now open your Showcase editor page. I am going to assume you already have a showcase setup and saved using the Load Preset Panel? If not, create one with the option 'Enable Link to Profile' is checked. Save the showcase.<br>
	4. Click on the little green Editor button at the top left of your showcase. Now open the Member Template panel.<br>
	5. Now you will see the overall template container. Double click, or press its plus (+) button to reveal its contents.<br>
	6. Open its 'Attrs' tab. In the 'Link:' input field replace its current contents with the embed meta key code for the custom bio url.<br>
	7. So basically you need to enter it like this: {{MTS Custom Link}}<br>
	8. You may want to set the 'Target:' value to _blank in case you want the link to open on a separate page.<br>
	8. Hit 'Apply Settings' at the bottom of the showcase editor. Once the changes are applied click on 'Save Applied Settings'.<br>
	<br>
	That's it. If you followed all the steps you should now have a showcase with custom links. In case of issues please contact me via the <a href="http://codecanyon.net/item/modern-team-showcase-wordpress-plugin/12173695/support" target="_blank">support form</a>.
	</div>

	<!-- Bio page template -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		I want to build custom templates for the member bio pages. How do I achieve this?
	</div>
	<div class="wmts_faqs_a">
		Head over to your theme folder and copy your 'single.php' file. Rename the copy 'single-modernteammembers.php'. Leave it in the same folder. This file will now be your custom template file.
	</div>

	<!-- Bio page styling -->
	<div class="wmts_faqs_q"><i class="fa fa-question-circle"></i>
		What CSS selectors do I use to help me style my member bio pages?
	</div>
	<div class="wmts_faqs_a">
		You can use the parent selector body.single-modernteammembers and then child selectors beneath it. The initial look of your member bio page will depend on how your theme styles post pages.
	</div>

</div>